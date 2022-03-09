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

    /** @test  */
    function ログインに成功すると200を返し認証される()
    {
        $user = User::factory()->create();
        $this->post('/api/v1/csrf-cookie');
        $response = $this->post('api/v1/login', [
            'email' => $user->email,
            'password' => 'password',
        ]);
        $response->assertStatus(200);
        
    }

    /** @test  */
    // function ログインに失敗すると400を返す()
    // {
        
    // }
}
