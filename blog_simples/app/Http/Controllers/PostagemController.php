<?php

namespace App\Http\Controllers;

use App\Models\Postagem;
use Illuminate\Http\Request;

class PostagemController extends Controller
{
    public function index()
    {
        $postagens = Postagem::with(['user', 'comentarios'])
            ->latest()
            ->paginate(10);
        return view('postagem.index', compact('postagens'));
    }

    public function create()
    {
        return view('postagem.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'titulo' => 'required|string|max:255',
            'conteudo' => 'required|string',
            'foto' => 'nullable|image|max:2048' // 2MB max
        ]);

        try {
            if ($request->hasFile('foto')) {
                $validated['foto'] = $request->file('foto')->store('postagens', 'public');
            }

            $postagem = auth()->user()->postagens()->create($validated);

            return redirect()
                ->route('postagens.show', $postagem)
                ->with('success', 'Postagem criada com sucesso!');
        } catch (\Exception $e) {
            return back()
                ->withInput()
                ->with('error', 'Erro ao criar postagem.');
        }
    }

    public function show(Postagem $postagem)
    {
        $postagem->load(['user', 'comentarios.user']);
        return view('postagem.show', compact('postagem'));
    }

    public function edit(Postagem $postagem)
    {
        $this->authorize('update', $postagem);
        return view('postagem.edit', compact('postagem'));
    }

    public function update(Request $request, Postagem $postagem)
    {
        $this->authorize('update', $postagem);

        $validated = $request->validate([
            'titulo' => 'required|string|max:255',
            'conteudo' => 'required|string',
            'foto' => 'nullable|image|max:2048'
        ]);

        try {
            if ($request->hasFile('foto')) {
                // Remove old photo if exists
                if ($postagem->foto) {
                    Storage::disk('public')->delete($postagem->foto);
                }
                $validated['foto'] = $request->file('foto')->store('postagens', 'public');
            }

            $postagem->update($validated);

            return redirect()
                ->route('postagens.show', $postagem)
                ->with('success', 'Postagem atualizada com sucesso!');
        } catch (\Exception $e) {
            return back()
                ->withInput()
                ->with('error', 'Erro ao atualizar postagem.');
        }
    }

    public function destroy(Postagem $postagem)
    {
        $this->authorize('delete', $postagem);

        try {
            if ($postagem->foto) {
                Storage::disk('public')->delete($postagem->foto);
            }

            $postagem->delete();

            return redirect()
                ->route('postagens.index')
                ->with('success', 'Postagem excluída com sucesso!');
        } catch (\Exception $e) {
            return back()->with('error', 'Erro ao excluir postagem.');
        }
    }
}
