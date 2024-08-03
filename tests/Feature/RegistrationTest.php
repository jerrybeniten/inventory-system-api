<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Faker\Factory as Faker;


class RegistrationTest extends TestCase
{
    public function test_a_user_can_register()
    {
        $faker = Faker::create();
        $email = $faker->unique()->safeEmail();
        $response = $this->postJson('/api/v1/auth/register', [
            'name' =>  'Test',
            'email' => $email,
            'password' => 'password',
        ]);

        $this->assertDatabaseHas('users', [
            'email' => $email,
        ]);
    }
}
