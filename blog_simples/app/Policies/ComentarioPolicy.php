<?php

namespace App\Policies;

use App\Models\Comentario;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class ComentarioPolicy
{
    /**
     * Determine se o usuário pode visualizar qualquer comentário.
     */
    public function viewAny(User $user): bool
    {
        return true; // Todos podem ver comentários
    }

    /**
     * Determine se o usuário pode visualizar o comentário.
     */
    public function view(User $user, Comentario $comentario): bool
    {
        return true; // Todos podem ver comentários
    }

    /**
     * Determine se o usuário pode criar comentários.
     */
    public function create(User $user): bool
    {
        return true; // Usuários autenticados podem criar comentários
    }

    /**
     * Determine se o usuário pode atualizar o comentário.
     */
    public function update(User $user, Comentario $comentario): Response
    {
        return $user->id === $comentario->user_id
            ? Response::allow()
            : Response::deny('Você não tem permissão para editar este comentário.');
    }

    /**
     * Determine se o usuário pode excluir o comentário.
     */
    public function delete(User $user, Comentario $comentario): Response
    {
        return $user->id === $comentario->user_id
            ? Response::allow()
            : Response::deny('Você não tem permissão para excluir este comentário.');
    }
}
