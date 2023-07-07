<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Repositories\BookRepositoryInterface;
use Illuminate\Http\Request;

class BookController extends Controller
{
    protected $bookRepository;

    public function __construct(BookRepositoryInterface $bookRepository)
    {
        $this->bookRepository = $bookRepository;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return $this->bookRepository->all();

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        return $this->bookRepository->save($request->query());
    }

    /**
     * Display the specified resource.
     */
    public function show(Book $book)
    {
       return $this->bookRepository->find($book->id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Book $book)
    {
       return $this->bookRepository->update($book->id, $request->query());
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Book $book)
    {
       return $this->bookRepository->delete($book->id);
    }
}