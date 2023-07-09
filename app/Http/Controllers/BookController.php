<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBookRequest;
use App\Http\Requests\UpdateBookRequest;
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
    public function index(Request $request)
    {
        return $this->bookRepository->all($request->input('limit'));

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBookRequest $request)
    {
        return $this->bookRepository->create($request->validated());
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
    public function update(UpdateBookRequest $request, Book $book)
    {
       return $this->bookRepository->update($book->id, $request->validated());
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Book $book)
    {
       return $this->bookRepository->delete($book->id);
    }
}