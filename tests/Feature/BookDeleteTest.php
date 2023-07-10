<?php

namespace Tests\Feature;

use App\Models\Book;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class BookDeleteTest extends TestCase
{
  use RefreshDatabase;

  /** @test */
  public function it_returns_a_200_success_response_on_successfully_removing_the_book(): void
  {
    Sanctum::actingAs(User::factory()->create());
    $book = Book::factory()->create();

    $this->deleteJson("/api/books/{$book->id}", [])->assertOk();
    $this->getJson("/api/books/{$book->id}")->assertNotFound();
  }
}