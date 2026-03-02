<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Post;

class PostPolicy
{
    public function create(User $user): bool
    {
        return $user->isAuthor();
    }

    public function view(User $user, Post $post): bool
    {
        return $user->isAdmin()
            || $user->isManager()
            || $post->user_id === $user->id;
    }

    public function update(User $user, Post $post): bool
    {
        return $user->isAuthor()
            && $post->user_id === $user->id;
    }

    public function approve(User $user, Post $post): bool
    {
        return $user->isManager() || $user->isAdmin();
    }

    public function delete(User $user, Post $post): bool
    {
        return $user->isAdmin();
    }
}