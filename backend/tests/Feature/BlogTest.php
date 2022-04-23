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

    /** @test store */
    function ブログが作成される()
    {
        Sanctum::actingAs(
            User::factory()->create(),
            ['*']
        );
        $blog = [
            'title' => 'test',
            'body'  => 'body-test',
            'status' => 1,
            'thummbnail' => 'http://localhost/storage/images/pHhD0WxAK9vDFsnJzlfTKMC0nT5symfkVt2vRzF4.jpg',
        ];

        $response = $this->post('api/v1/admin/blogs/store', $blog);
        $response->assertStatus(200)
                ->assertJsonStructure([
                    'status',
                    'message' => [
                        'success'
                    ],
                ]);
    }

    /** @test store */
    function ブログが作成されない()
    {
        Sanctum::actingAs(
            User::factory()->create(),
            ['*']
        );
        $blog = [
            'title' => '',
            'body'  => '',
            'status' => '',
            'thummbnail' => '',
        ];

        $response = $this->post('api/v1/admin/blogs/store', $blog);
        $response->assertStatus(400)
                ->assertJsonStructure([
                    'status',
                    'message' => [
                        'title',
                        'body',
                        'status',
                        'thummbnail',
                    ],
                ]);
    }
}
