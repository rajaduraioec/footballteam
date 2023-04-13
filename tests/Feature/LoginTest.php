<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;

class LoginTest extends TestCase
{
    private $user;

    public function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory([
            'email' => 'test@example.com',
            'password' => bcrypt('password'),
        ])->create();
    }
    /**
     * A basic feature test example.
     */
    public function test_user_can_login_with_correct_credentials(): void
    {
        $response = $this->json('POST', '/api/login', [
            'email' => 'test@example.com',
            'password' => 'password',
        ]);

        $response->assertStatus(200);

        $response->assertJson([
            'success' => true,
            'message' => 'User logged in successfully.',
            'data' => [
                'token' => true,
                'name' => $this->user->name,
            ],
        ]);
    }

    public function test_user_can_not_login_with_correct_credentials(): void
    {
        $response = $this->json('POST', '/api/login', [
            'email' => 'test@example.com',
            'password' => 'wrong-password',
        ]);
    
        $response->assertUnauthorized();
    
        $response->assertJson([
            'success' => false,
            'message' => 'Unauthorized.',
            'data' => [
                'error' => 'Invalid Credentials',
            ] 
        ]);
    }
}
