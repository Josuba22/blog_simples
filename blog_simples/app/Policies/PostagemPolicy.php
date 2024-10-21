<?php

namespace App\Policies;

use App\Models\Postagem;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class PostagemPolicy
{
    /**
     * Determine se o usuário pode visualizar qualquer postagem.
     */
    public function viewAny(User $user): bool
    {
        return true; // Todos podem ver a lista de postagens
    }

    /**
     * Determine se o usuário pode visualizar a postagem.
     */
    public function view(?User $user, Postagem $postagem): bool
    {
        return true; // Todos podem ver postagens individuais
    }

    /**
     * Determine se o usuário pode criar postagens.
     */
    public function create(User $user): bool
    {
        return true; // Usuários autenticados podem criar postagens
    }

    /**
     * Determine se o usuário pode atualizar a postagem.
     */
    public function update(User $user, Postagem $postagem): Response
    {
        return $user->id === $postagem->user_id
            ? Response::allow()
            : Response::deny('Você não tem permissão para editar esta postagem.');
    }

    /**
     * Determine se o usuário pode excluir a postagem.
     */
    public function delete(User $user, Postagem $postagem): Response
    {
        return $user->id === $postagem->user_id
            ? Response::allow()
            : Response::deny('Você não tem permissão para excluir esta postagem.');
    }
}
