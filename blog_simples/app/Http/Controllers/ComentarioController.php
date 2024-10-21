<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Comentario;
use App\Models\Postagem;
use Illuminate\Http\Request;

class ComentarioController extends Controller
{
    public function store(Request $request, Postagem $postagem)
    {
        $validated = $request->validate([
            'conteudo' => 'required|string|max:255',
            'postagem_id' => 'required|exists:postagens,id'
        ]);

        try {
            $comentario = new Comentario([
                'conteudo' => $validated['conteudo'],
                'user_id' => auth()->id(),
            ]);

            $postagem->comentarios()->save($comentario);

            return redirect()
                ->route('postagens.show', $postagem)
                ->with('success', 'Comentário criado com sucesso!');
        } catch (\Exception $e) {
            return back()
                ->withInput()
                ->with('error', 'Erro ao criar comentário. Tente novamente.');
        }
    }

    public function update(Request $request, Comentario $comentario)
    {
        $this->authorize('update', $comentario);

        $validated = $request->validate([
            'conteudo' => 'required|string|max:255',
        ]);

        try {
            $comentario->update($validated);
            return redirect()
                ->route('postagens.show', $comentario->postagem)
                ->with('success', 'Comentário atualizado com sucesso!');
        } catch (\Exception $e) {
            return back()
                ->withInput()
                ->with('error', 'Erro ao atualizar comentário.');
        }
    }

    public function destroy(Comentario $comentario)
    {
        $this->authorize('delete', $comentario);

        try {
            $comentario->delete();
            return redirect()
                ->route('postagens.show', $comentario->postagem)
                ->with('success', 'Comentário excluído com sucesso!');
        } catch (\Exception $e) {
            return back()->with('error', 'Erro ao excluir comentário.');
        }
    }
}
