<?php

namespace Tests\Feature;

use App\Models\Book;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Database\Eloquent\Factories\Factory;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class BookCreateTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_returns_the_book_on_successfully_creating_a_new_book(): void
    {
        $book = Book::factory()->make();
        $this->postJson('/api/books', $book->toArray())->assertCreated()->assertJson($book->toArray());
    }


    /** @test */
    public function it_returns_appropriate_field_validation_errors_when_creating_a_new_book_with_invalid_inputs(): void
    {
        $book = Book::factory()->make([
            'title' => '',
            'description' => '',
            'price' => 'not price',
        ]);

        $response = $this->postJson('/api/books', $book->toArray());

        $response->assertStatus(422)->assertJson(
            [
                "message" => "The title field is required. (and 2 more errors)",
                "errors" => [
                    "title" => ["The title field is required."],
                    "description" => [
                        "The description field is required."
                    ],
                    "price" => [
                        "The price field must be a number."
                    ]
                ]
            ]
        );
    }

    public function setUp(): void
    {
        parent::setUp();
        Sanctum::actingAs(User::factory()->create());
    }
}