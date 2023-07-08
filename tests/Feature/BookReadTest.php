<?php

namespace Tests\Feature;

use App\Models\Book;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class BookReadTest extends TestCase
{

    use RefreshDatabase;

    /** @test */
    public function it_returns_the_correct_books_with_limit(): void
    {
        Book::factory()->count(51)->create();

        $this->call("GET", '/api/books', ['limit' => 30])->assertOk()->assertJsonCount(30, "data");
        $this->call("GET", '/api/books', ['limit' => 80])->assertOk()->assertJsonCount(50, "data");
        $this->getJson('/api/books')->assertOk()->assertJsonCount(20, "data");
      
    }
}