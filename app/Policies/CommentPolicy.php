<?php

namespace App\Policies;

use App\User;
use App\Comment;
use Illuminate\Auth\Access\HandlesAuthorization;

class CommentPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the comment.
     *
     * @param  \App\User  $user
     * @param  \App\Comment  $comment
     * @return mixed
     */
    public function view(User $user)
    {
        return true;
    }

    /**
     * Determine whether the user can create comments.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return
            $user->is_active
        && !$user->isBanned();

    }


    public function like(User $user, Comment $comment)
    {
        return
            $user->is_active
        && !$user->isBanned()
        && !($user->id == $comment->user_id)
        && ($comment->likes()->where('user_id', $user->id)->count() === 0);
    }


    /**
     * Determine whether the user can update the comment.
     *
     * @param  \App\User  $user
     * @param  \App\Comment  $comment
     * @return mixed
     */
    public function update(User $user, Comment $comment)
    {
        return
            $user->is_active
        && !$user->isBanned()
        && ($user->isAdmin() || ($user->id == $comment->user_id));
    }

    /**
     * Determine whether the user can delete the comment.
     *
     * @param  \App\User  $user
     * @param  \App\Comment  $comment
     * @return mixed
     */
    public function delete(User $user, Comment $comment)
    {
        return
            $user->is_active
        && !$user->isBanned()
        && ($user->isAdmin() || ($user->id == $comment->user_id));
    }
}
