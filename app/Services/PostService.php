<?php

namespace App\Services;

use App\Models\Post;
use App\Models\PostLog;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Auth\Access\AuthorizationException;

class PostService
{
    /**
     * CREATE POST
     */
    public function create(array $data, User $user): Post
    {
        return DB::transaction(function () use ($data, $user) {

            $post = Post::create([
                'user_id' => $user->id,
                'title'   => $data['title'],
                'body'    => $data['body'],
                'status'  => 'pending',
            ]);

            $this->log($post, 'created', $user);

            return $post;
        });
    }

    /**
     * UPDATE POST
     */
    public function update(Post $post, array $data, User $user): Post
    {
        return DB::transaction(function () use ($post, $data, $user) {

            // 🔥 Business rule check
            if ($post->status !== 'pending') {
                throw new AuthorizationException('Post already processed');
            }

            $post->update([
                'title' => $data['title'],
                'body'  => $data['body'],
            ]);

            $this->log($post, 'updated', $user);

            return $post;
        });
    }

    /**
     * APPROVE POST
     */
    public function approve(Post $post, User $user): Post
    {
        return DB::transaction(function () use ($post, $user) {

            // 🔥 FIX HERE
            if ($post->status !== 'pending') {
                throw new AuthorizationException('Post already processed');
            }

            $post->update([
                'status' => 'approved',
                'approved_by' => $user->id,
            ]);

            $this->log($post, 'approved', $user);

            return $post;
        });
    }

    /**
     * REJECT POST
     */
    public function reject(Post $post, User $user, string $reason): Post
    {
        return DB::transaction(function () use ($post, $user, $reason) {

            // 🔥 FIX HERE ALSO
            if ($post->status !== 'pending') {
                throw new AuthorizationException('Post already processed');
            }

            $post->update([
                'status' => 'rejected',
                'rejected_reason' => $reason,
            ]);

            $this->log($post, 'rejected', $user, [
                'reason' => $reason
            ]);

            return $post;
        });
    }

    /**
     * DELETE POST
     */
    public function delete(Post $post, User $user): void
    {
        DB::transaction(function () use ($post, $user) {

            $postId = $post->id;

            $post->delete();

            $this->logRaw($postId, 'deleted', $user);
        });
    }

    /**
     * LOG HELPER (WITH MODEL)
     */
    protected function log(Post $post, string $action, User $user, array $meta = []): void
    {
        PostLog::create([
            'post_id'      => $post->id,
            'action'       => $action,
            'performed_by' => $user->id,
            'meta'         => json_encode($meta),
        ]);
    }

    /**
     * LOG HELPER (WITHOUT MODEL - for delete)
     */
    protected function logRaw(int $postId, string $action, User $user, array $meta = []): void
    {
        PostLog::create([
            'post_id'      => $postId,
            'action'       => $action,
            'performed_by' => $user->id,
            'meta'         => json_encode($meta),
        ]);
    }
}