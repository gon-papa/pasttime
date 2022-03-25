<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

/**
 * @see App/Http/Controllers/api/UserController.php
 * 
 * 
 */

class UserTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    protected $loginUrl = 'api/v1/login';

    public function setUp(): void
    {
        parent::setUp();
        $this->post('/api/v1/csrf-cookie');
    }

    /** @test  */
    function ログインに成功すると200を返し認証される()
    {
        $user = User::factory()->create();
        $response = $this->post($this->loginUrl, [
            'email' => $user->email,
            'password' => 'password',
        ]);
        $response->assertStatus(200);
    }

    /** @test  */
    function ログインに失敗した場合に400を返す()
    {
        User::factory()->create();
        $response = $this->post($this->loginUrl, [
            'email' => $this->faker->email(),
            'password' => $this->faker->password(),
        ]);
        $response->assertStatus(400)
                ->assertJson([
                    'status' => 400,
                    'message' => ['error' => '登録されていません'],
                ]);
    }

    /** @test  */
    function バリデーションエラーなら400を返し、エラーメッセージを返す()
    {
        User::factory()->create();
        $response = $this->post($this->loginUrl, [
            'email' => '',
            'password' => '',
        ]);
        $response->assertStatus(400);
        $response->assertJson([
            'status' => 400,
            'message' => [
                'email' => [
                    'メールアドレスを入力してください'
                ],
                'password' => [
                    'パスワードを入力してください'
                ]
            ]
        ]);
    }
}
