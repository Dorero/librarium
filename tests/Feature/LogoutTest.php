<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class LogoutTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function it_returns_a_200_success_response_on_successfully_removing_token(): void
    {
        $user = User::factory()->create();

        Sanctum::actingAs($user);

        $this->delete('/api/logout')->assertOk()->assertJson([
            'message' => 'Logged out successfully',
        ]);

        $this->assertCount(0, $user->tokens);
    }
}