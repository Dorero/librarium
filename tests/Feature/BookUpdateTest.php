<?php

namespace Tests\Feature;

use App\Models\Book;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class BookUpdateTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_returns_the_updated_book_on_successfully_updating_the_book(): void
    {
        $book = Book::factory()->create();
        $response = $this->putJson("/api/books/{$book->id}", $book->toArray());

        $response->assertStatus(200)->assertJson($book->toArray());
    }
}
