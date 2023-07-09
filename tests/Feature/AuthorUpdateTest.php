<?php

namespace Tests\Feature;

use App\Models\Author;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AuthorUpdateTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function it_returns_the_updated_author_on_successfully_updating_the_author(): void
    {
        $author = Author::factory()->create();
        $this->putJson("/api/authors/{$author->id}", $author->toArray())->assertOk()->assertJson($author->toArray());
    }
}
