<?php

namespace Tests\Feature;

use App\Models\Author;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class AuthorCreateTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function it_returns_the_author_on_successfully_creating_a_new_author(): void
    {
        Sanctum::actingAs(User::factory()->create());
        $author = Author::factory()->make();
       
        $this->postJson('/api/authors', $author->toArray())->assertCreated()->assertJson($author->toArray());
    }
}
