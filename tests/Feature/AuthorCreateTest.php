<?php

namespace Tests\Feature;

use App\Models\Author;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AuthorCreateTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function it_returns_the_author_on_successfully_creating_a_new_author(): void
    {
        $author = Author::factory()->make();
       
        $this->postJson('/api/authors', $author->toArray())->assertCreated()->assertJson($author->toArray());
    }
}
