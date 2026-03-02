<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Post;
use App\Models\PostLog;
use App\Models\User;
use App\Enums\PostStatus;

class PostSeeder extends Seeder
{
    public function run(): void
    {
        DB::transaction(function () {

            $author = User::where('role', 'author')->first();
            $admin  = User::where('role', 'admin')->first();

            if (!$author) {
                return;
            }

            /*
            |--------------------------------------------------------------------------
            | Pending Post
            |--------------------------------------------------------------------------
            */
            $pendingPost = Post::create([
                'user_id' => $author->id,
                'title'   => 'Pending Post',
                'body'    => 'This is a pending post',
                'status'  => PostStatus::Pending,
            ]);

            PostLog::create([
                'post_id'      => $pendingPost->id,
                'action'       => 'created',
                'performed_by' => $author->id,
                'meta'         => json_encode(['status' => 'pending']),
            ]);


            /*
            |--------------------------------------------------------------------------
            | Approved Post
            |--------------------------------------------------------------------------
            */
            $approvedPost = Post::create([
                'user_id'     => $author->id,
                'title'       => 'Approved Post',
                'body'        => 'This is approved',
                'status'      => PostStatus::Approved,
                'approved_by' => $admin?->id,
            ]);

            PostLog::create([
                'post_id'      => $approvedPost->id,
                'action'       => 'created',
                'performed_by' => $author->id,
                'meta'         => json_encode(['status' => 'approved']),
            ]);

            if ($admin) {
                PostLog::create([
                    'post_id'      => $approvedPost->id,
                    'action'       => 'approved',
                    'performed_by' => $admin->id,
                    'meta'         => json_encode(['approved_by' => $admin->id]),
                ]);
            }


            /*
            |--------------------------------------------------------------------------
            | Rejected Post
            |--------------------------------------------------------------------------
            */
            $rejectedPost = Post::create([
                'user_id'         => $author->id,
                'title'           => 'Rejected Post',
                'body'            => 'This is rejected',
                'status'          => PostStatus::Rejected,
                'rejected_reason' => 'Invalid content',
            ]);

            PostLog::create([
                'post_id'      => $rejectedPost->id,
                'action'       => 'created',
                'performed_by' => $author->id,
                'meta'         => json_encode(['status' => 'rejected']),
            ]);

            if ($admin) {
                PostLog::create([
                    'post_id'      => $rejectedPost->id,
                    'action'       => 'rejected',
                    'performed_by' => $admin->id,
                    'meta'         => json_encode(['reason' => 'Invalid content']),
                ]);
            }

        });
    }
}