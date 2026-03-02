<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Http\Requests\RejectPostRequest;
use App\Http\Resources\PostResource;
use App\Models\Post;
use App\Services\PostService;
use App\Helpers\ApiResponse;
use Illuminate\Http\Request;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Validation\ValidationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class PostController extends Controller
{
    use AuthorizesRequests;

    protected PostService $service;

    public function __construct(PostService $service)
    {
        $this->service = $service;
    }

    public function index(Request $request)
    {
        $user = $request->user();

        $query = Post::with('author')->latest();

        if ($user->isAuthor()) {
            $query->where('user_id', $user->id);
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $posts = $query->paginate(10);

        return ApiResponse::success(
            PostResource::collection($posts)->response()->getData(true),
            'Posts fetched successfully'
        );
    }

    public function store(StorePostRequest $request)
    {
        try {
            $this->authorize('create', Post::class);

            $post = $this->service->create($request->validated(), $request->user());

            return ApiResponse::success(
                new PostResource($post->load('author')),
                'Post created successfully',
                201
            );

        } catch (AuthorizationException $e) {
            return ApiResponse::error($e->getMessage(), 403);
        }
    }

    public function update(UpdatePostRequest $request, Post $post)
    {
        try {
            $this->authorize('update', $post);

            $post = $this->service->update($post, $request->validated(), $request->user());

            return ApiResponse::success(new PostResource($post), 'Post updated successfully');

        } catch (AuthorizationException $e) {
            return ApiResponse::error($e->getMessage(), 403);

        } catch (\Exception $e) {
            return ApiResponse::error($e->getMessage(), 400);
        }
    }

    public function approve(Post $post, Request $request)
    {
        try {
            $this->authorize('approve', $post);

            $post = $this->service->approve($post, $request->user());

            return ApiResponse::success(new PostResource($post), 'Post approved successfully');

        } catch (AuthorizationException $e) {
            return ApiResponse::error($e->getMessage(), 403);

        } catch (\Exception $e) {
            return ApiResponse::error($e->getMessage(), 400);
        }
    }

    public function reject(RejectPostRequest $request, Post $post)
    {
        try {
            $this->authorize('approve', $post);

            $post = $this->service->reject($post, $request->user(), $request->reason);

            return ApiResponse::success(new PostResource($post), 'Post rejected successfully');

        } catch (AuthorizationException $e) {
            return ApiResponse::error($e->getMessage(), 403);

        } catch (\Exception $e) {
            return ApiResponse::error($e->getMessage(), 400);
        }
    }

    public function destroy(Post $post, Request $request)
    {
        try {
            $this->authorize('delete', $post);

            $this->service->delete($post, $request->user());

            return ApiResponse::success(null, 'Post deleted successfully');

        } catch (AuthorizationException $e) {
            return ApiResponse::error($e->getMessage(), 403);
        }
    }
}