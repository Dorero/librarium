<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class RegistrationTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function it_returns_user_with_token_on_valid_registration(): void
    {
        $this->postJson('/api/register', [
            'email' => "domenoer@gmail.com",
            "password" => "!@#123QWEasd"
        ])->assertCreated();
    }

    /** @test */
    public function it_returns_field_required_validation_errors_on_invalid_registration()
    {
        $this->postJson('/api/register', [])->assertStatus(422)
            ->assertJson([
                'errors' => [
                    'email' => ['The email field is required.'],
                    'password' => ['The password field is required.'],
                ]
            ]);
    }

    /** @test */
    public function it_returns_password_validation_errors_on_invalid_registration()
    {
        $this->postJson('/api/register', [
            'email' => "domenoer@gmail.com",
            "password" => "1234567"
        ])->assertStatus(422)
            ->assertJson([
                'errors' => [
                    'password' => [
                        'The password field must be at least 8 characters.',
                        'The password field must contain at least one uppercase and one lowercase letter.',
                        'The password field must contain at least one letter.',
                    ],
                ]
            ]);
    }

    /** @test */
    public function it_returns_validation_errors_when_using_duplicate_values_on_registration()
    {
        $user = User::factory()->create();


        $this->postJson('/api/register', $user->toArray() + ['password' => "!@#123QWEasd"])->assertStatus(422)
            ->assertJson([
                'errors' => [
                    'email' => ['The email has already been taken.'],
                ]
            ]);
    }

    public function setUp(): void {
        parent::setUp();
        Sanctum::actingAs(User::factory()->create());
    }
}