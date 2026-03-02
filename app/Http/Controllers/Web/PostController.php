<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Helpers\PostLogHelper;

class PostController extends Controller
{
    use AuthorizesRequests;

    public function index()
    {
        $posts = Post::with('author')->latest()->paginate(10);
        return view('posts.index', compact('posts'));
    }

    /**
     * CREATE
     */
    public function create()
    {
        $this->authorize('create', Post::class);
        return view('posts.create');
    }

    public function store(Request $request)
    {
        $this->authorize('create', Post::class);

        $data = $request->validate([
            'title' => 'required|string|max:255',
            'body' => 'required|string|min:5',
        ]);

        $post = Post::create([
            'user_id' => auth()->id(),
            'title' => $data['title'],
            'body' => $data['body'],
            'status' => 'pending',
        ]);

        // ✅ LOG
        PostLogHelper::log($post->id, 'created', auth()->id());

        return redirect()->route('posts.index')->with('success', 'Post created successfully');
    }

    /**
     * UPDATE
     */
    public function edit(Post $post)
    {
        $this->authorize('update', $post);
        return view('posts.edit', compact('post'));
    }

    public function update(Request $request, Post $post)
    {
        $this->authorize('update', $post);

        if ($post->status !== 'pending') {
            return back()->with('error', 'You cannot update this post anymore');
        }

        $data = $request->validate([
            'title' => 'required|string|max:255',
            'body' => 'required|string|min:5',
        ]);

        $post->update($data);

        // ✅ LOG (optional)
        PostLogHelper::log($post->id, 'updated', auth()->id());

        return redirect()->route('posts.index')->with('success', 'Post updated successfully');
    }

    /**
     * APPROVE
     */
    public function approve(Post $post)
    {
        $this->authorize('approve', $post);

        if ($post->status !== 'pending') {
            return back()->with('error', 'Post already processed');
        }

        $post->update([
            'status' => 'approved',
            'approved_by' => auth()->id(),
        ]);

        // ✅ LOG
        PostLogHelper::log($post->id, 'approved', auth()->id());

        return back()->with('success', 'Post approved successfully');
    }

    /**
     * REJECT
     */
    public function reject(Request $request, Post $post)
    {
        $this->authorize('approve', $post);

        if ($post->status !== 'pending') {
            return back()->with('error', 'Post already processed');
        }

        $request->validate([
            'reason' => 'required|string|max:255'
        ]);

        $post->update([
            'status' => 'rejected',
            'rejected_reason' => $request->reason,
        ]);

        // ✅ LOG WITH META
        PostLogHelper::log($post->id, 'rejected', auth()->id(), [
            'reason' => $request->reason
        ]);

        return back()->with('success', 'Post rejected successfully');
    }

    /**
     * DELETE
     */
    public function destroy(Post $post)
    {
        $this->authorize('delete', $post);

        // store post id before delete
        $postId = $post->id;

        $post->delete();

        // ✅ LOG
        PostLogHelper::log($postId, 'deleted', auth()->id());

        return back()->with('success', 'Post deleted successfully');
    }

    /**
     * LOG VIEW
     */
    public function logs(Post $post)
    {
        $logs = $post->logs()->with('user')->latest()->get();

        return view('posts.logs', compact('post', 'logs'));
    }
}