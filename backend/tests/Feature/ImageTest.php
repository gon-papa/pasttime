<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Blog;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class ImageTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    protected $loginUrl = 'api/v1/login';
    protected $user;

    public function setUp(): void
    {
        parent::setUp();
        // ログイン処理
        $this->post('/api/v1/csrf-cookie');
        $this->user = Sanctum::actingAs(
            User::factory()->create(),
            ['*']
        );
    }

    /** @test index */
    public function ストレージのimageディレクトリ内の画像URLを全て取得する()
    {
        // モック作成
        // Blog::factory()->create(['user_id' => $this->user->id]);
    }
}
