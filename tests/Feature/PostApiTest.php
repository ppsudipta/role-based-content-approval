<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Post;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Sanctum\Sanctum;

class PostApiTest extends TestCase
{
    use RefreshDatabase;

    protected $author;
    protected $manager;
    protected $admin;

    protected function setUp(): void
    {
        parent::setUp();

        // Create users
        $this->author = User::factory()->author()->create();
        $this->manager = User::factory()->manager()->create();
        $this->admin = User::factory()->admin()->create();
    }

    #[\PHPUnit\Framework\Attributes\Test]
    public function author_can_create_post()
    {
        Sanctum::actingAs($this->author);

        $response = $this->postJson('/api/posts', [
            'title' => 'Test Post',
            'body' => 'Test Content',
        ]);

        $response->assertStatus(201)
            ->assertJsonPath('status', 'success');

        $this->assertDatabaseHas('posts', [
            'title' => 'Test Post',
            'user_id' => $this->author->id,
        ]);
    }

    #[\PHPUnit\Framework\Attributes\Test]
    public function manager_cannot_create_post()
    {
        Sanctum::actingAs($this->manager);

        $response = $this->postJson('/api/posts', [
            'title' => 'Test Post',
            'body' => 'Test Content',
        ]);

        $response->assertStatus(403);
    }

    #[\PHPUnit\Framework\Attributes\Test]
    public function author_can_update_own_post()
    {
        $post = Post::factory()->create(['user_id' => $this->author->id]);

        Sanctum::actingAs($this->author);

        $response = $this->putJson("/api/posts/{$post->id}", [
            'title' => 'Updated Title',
            'body' => 'Updated Body',
        ]);

        $response->assertStatus(200);

        $this->assertDatabaseHas('posts', [
            'id' => $post->id,
            'title' => 'Updated Title',
        ]);
    }

    #[\PHPUnit\Framework\Attributes\Test]
    public function author_cannot_update_other_users_post()
    {
        $post = Post::factory()->create(); // another user

        Sanctum::actingAs($this->author);

        $response = $this->putJson("/api/posts/{$post->id}", [
            'title' => 'Hack',
            'body' => 'Test Body Content',
        ]);

        $response->assertStatus(403);
    }

    #[\PHPUnit\Framework\Attributes\Test]
    public function manager_can_approve_post()
    {
        $post = Post::factory()->create();

        Sanctum::actingAs($this->manager);

        $response = $this->postJson("/api/posts/{$post->id}/approve");

        $response->assertStatus(200);

        $this->assertDatabaseHas('posts', [
            'id' => $post->id,
            'status' => 'approved',
        ]);
    }

    #[\PHPUnit\Framework\Attributes\Test]
    public function author_cannot_approve_post()
    {
        $post = Post::factory()->create();

        Sanctum::actingAs($this->author);

        $response = $this->postJson("/api/posts/{$post->id}/approve");

        $response->assertStatus(403);
    }

    #[\PHPUnit\Framework\Attributes\Test]
    public function manager_can_reject_post()
    {
        $post = Post::factory()->create();

        Sanctum::actingAs($this->manager);

        $response = $this->postJson("/api/posts/{$post->id}/reject", [
            'reason' => 'Invalid content',
        ]);

        $response->assertStatus(200);

        $this->assertDatabaseHas('posts', [
            'id' => $post->id,
            'status' => 'rejected',
        ]);
    }

    #[\PHPUnit\Framework\Attributes\Test]
    public function cannot_reject_without_reason()
    {
        $post = Post::factory()->create();

        Sanctum::actingAs($this->manager);

        $response = $this->postJson("/api/posts/{$post->id}/reject", []);

        $response->assertStatus(422);
    }

    #[\PHPUnit\Framework\Attributes\Test]
    public function admin_can_delete_post()
    {
        $post = Post::factory()->create();

        Sanctum::actingAs($this->admin);

        $response = $this->deleteJson("/api/posts/{$post->id}");

        $response->assertStatus(200);

        $this->assertSoftDeleted('posts', [
            'id' => $post->id,
        ]);
    }

    #[\PHPUnit\Framework\Attributes\Test]
    public function non_admin_cannot_delete_post()
    {
        $post = Post::factory()->create();

        Sanctum::actingAs($this->manager);

        $response = $this->deleteJson("/api/posts/{$post->id}");

        $response->assertStatus(403);
    }

    #[\PHPUnit\Framework\Attributes\Test]
    public function cannot_approve_already_approved_post()
    {
        $post = Post::factory()->approved()->create();

        Sanctum::actingAs($this->manager);

        $response = $this->postJson("/api/posts/{$post->id}/approve");

        $response->assertStatus(403);
    }

    #[\PHPUnit\Framework\Attributes\Test]
    public function author_can_view_only_own_posts()
    {
        // Author posts
        Post::factory()->count(2)->create(['user_id' => $this->author->id]);

        // Other posts
        Post::factory()->count(3)->create();

        Sanctum::actingAs($this->author);

        $response = $this->getJson('/api/posts');

        $response->assertStatus(200);

        // 🔥 PAGINATION STRUCTURE
        $this->assertCount(2, $response->json('data.data'));
    }

    #[\PHPUnit\Framework\Attributes\Test]
    public function manager_can_view_all_posts()
    {
        Post::factory()->count(3)->create();

        Sanctum::actingAs($this->manager);

        $response = $this->getJson('/api/posts');

        $response->assertStatus(200);

        // 🔥 PAGINATION STRUCTURE
        $this->assertCount(3, $response->json('data.data'));
    }
}