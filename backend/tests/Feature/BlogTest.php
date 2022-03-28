<?php

namespace Tests\Feature;

use App\Models\Blog;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

/**
 * @see App/Http/Controllers/api/BlogController.php
 *
 */

class BlogTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    protected $loginUrl = 'api/v1/login';

    public function setUp(): void
    {
        parent::setUp();
        $this->post('/api/v1/csrf-cookie');
    }

    /** @test index */
    function 認証されたユーザーはブログの一覧が返される()
    {
        $user = Sanctum::actingAs(
            User::factory()->create(),
            ['*']
        );
        Blog::factory()->create(['user_id' => $user->id]);

        $response = $this->get('api/v1/admin/blogs/index');
        $response->assertStatus(200)
            ->assertJsonStructure([
                'status',
                'blogs',
            ]);
        
    }

    /** @test index */
    function 認証されていないユーザーはブログの一覧が返されない()
    {
        $user = User::factory()->create();
        Blog::factory()->create(['user_id' => $user->id]);

        $response = $this->get('api/v1/admin/blogs/index');

        $response->assertStatus(500);
    }
}
