<?php

namespace Tests\Feature;

use App\Models\Author;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class AuthorReadTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_returns_the_correct_authors_with_limit(): void
    {
        Sanctum::actingAs(User::factory()->create());
        Author::factory()->count(51)->create();

        $this->call("GET", '/api/authors', ['limit' => 30])->assertOk()->assertJsonCount(30, "data");
    }
}
