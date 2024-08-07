<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserLoginTest extends TestCase
{ 
    public function test_user_can_login(): void
    {
        $password = 'password123';
        $user = User::factory()->create([
            'password' => bcrypt($password),
        ]);
        
        $response = $this->postJson('/api/v1/auth/login', [
            'email' => $user->email,
            'password' => $password,
        ]);
        
        $response->assertStatus(200)
            ->assertJson([
                'success' => true,
                'statusCode' => 200,
                'message' => 'User has been logged successfully.',
                'data' => [
                    'id' => $user->id,
                    'name' => $user->name,
                    'email' => $user->email,
                    'created_at' => $user->created_at->toISOString(),
                    'updated_at' => $user->updated_at->toISOString(),
                ],
            ]);
        
        $this->assertDatabaseHas('users', [
            'email' => $user->email,
        ]);
    }
}
