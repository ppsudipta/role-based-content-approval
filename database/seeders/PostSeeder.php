<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Post;
use App\Models\User;
use App\Enums\PostStatus;

class PostSeeder extends Seeder
{
    public function run(): void
    {
        $author = User::where('role', 'author')->first();
        $admin = User::where('role', 'admin')->first();

        if (!$author) return;

        // Pending Post
        Post::create([
            'user_id' => $author->id,
            'title' => 'Pending Post',
            'body' => 'This is a pending post',
            'status' => PostStatus::Pending
        ]);

        // Approved Post
        Post::create([
            'user_id' => $author->id,
            'title' => 'Approved Post',
            'body' => 'This is approved',
            'status' => PostStatus::Approved,
            'approved_by' => $admin?->id
        ]);

        // Rejected Post
        Post::create([
            'user_id' => $author->id,
            'title' => 'Rejected Post',
            'body' => 'This is rejected',
            'status' => PostStatus::Rejected,
            'rejected_reason' => 'Invalid content'
        ]);
    }
}