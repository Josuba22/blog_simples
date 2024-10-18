<?php

namespace App\Http\Controllers;

use App\Models\Comentario;
use App\Models\Postagem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class ComentarioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Comentario $comentario)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Comentario $comentario)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Comentario $comentario)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Comentario $comentario)
    {
        //
    }

    public function armazenar(Request $request, Postagem $postagem)
    {
        $validated = $request->validate([
            'conteudo' => 'required|string|max:255',
        ]);

        $comentario = new Comentario([
            'conteudo' => $validated['conteudo'],
        ]);

        $postagem->comentarios()->save($comentario);

        return redirect()->route('postagens.show', $postagem);
    }
}
