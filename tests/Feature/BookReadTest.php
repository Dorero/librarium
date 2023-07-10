<?php

namespace Tests\Feature;

use App\Models\Book;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class BookReadTest extends TestCase
{

    use RefreshDatabase;

    /** @test */
    public function it_returns_the_correct_books_with_limit(): void
    {
        Sanctum::actingAs(User::factory()->create());
        Book::factory()->count(51)->create();

        $this->call("GET", '/api/books', ['limit' => 30])->assertOk()->assertJsonCount(30, "data");
        $this->call("GET", '/api/books', ['limit' => 80])->assertOk()->assertJsonCount(50, "data");
        $this->getJson('/api/books')->assertOk()->assertJsonCount(20, "data");
      
    }
}