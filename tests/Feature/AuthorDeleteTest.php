<?php

namespace Tests\Feature;

use App\Models\Author;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class AuthorDeleteTest extends TestCase
{
  use RefreshDatabase;

  /** @test */
  public function it_returns_a_200_success_response_on_successfully_removing_the_author(): void
  {
    Sanctum::actingAs(User::factory()->create());
    $author = Author::factory()->create();

    $this->deleteJson("/api/authors/{$author->id}", [])->assertOk();
    $this->getJson("/api/authors/{$author->id}")->assertNotFound();
  }
}