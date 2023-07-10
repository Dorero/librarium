<?php

namespace Tests\Feature;

use App\Models\Book;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class BookUpdateTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_returns_the_updated_book_on_successfully_updating_the_book(): void
    {
        Sanctum::actingAs(User::factory()->create());
        $book = Book::factory()->create();
        $response = $this->putJson("/api/books/{$book->id}", $book->toArray());

        $response->assertStatus(200)->assertJson($book->toArray());
    }
}
