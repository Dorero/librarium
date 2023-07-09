<?php

namespace Tests\Feature;

use App\Models\Author;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AuthorReadTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_returns_the_correct_authors_with_limit(): void
    {
        Author::factory()->count(51)->create();

        $this->call("GET", '/api/authors', ['limit' => 30])->assertOk()->assertJsonCount(30, "data");
    }
}
