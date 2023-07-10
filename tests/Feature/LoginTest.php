<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class LoginTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function it_returns_a_user_with_valid_token_on_valid_login(): void
    {
        $password = ["password" => "!@#123QWEasd"];
        $user = User::factory()->create($password + []);
        $this->postJson('/api/login', $user->toArray() + $password)->assertOk();
    }

    /** @test */
    public function it_returns_appropriate_field_validation_errors_on_invalid_login()
    {

        $this->postJson('/api/login', [
            "email" => "bad@mail",
            "password" => "111233333332",
        ])->assertStatus(422)
            ->assertJson([
                'errors' => [
                    'email' => ['must be a valid email address.'],
                    'password' => ['must be a valid email address.'],
                ]
            ]);

    }
}