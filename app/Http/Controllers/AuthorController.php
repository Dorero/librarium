<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAuthorRequest;
use App\Http\Requests\UpdateAuthorRequest;
use App\Models\Author;
use App\Repositories\AuthorRepositoryInterface;
use Illuminate\Http\Request;

class AuthorController extends Controller
{

    protected $authorRepository;

    public function __construct(AuthorRepositoryInterface $authorRepository) {
        $this->authorRepository = $authorRepository;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
       return $this->authorRepository->all($request->input('limit'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAuthorRequest $request)
    {

        return $this->authorRepository->create($request->validated());
    }

    /**
     * Display the specified resource.
     */
    public function show(Author $author)
    {
        return $this->authorRepository->find($author->id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAuthorRequest $request, Author $author)
    {
        return $this->authorRepository->update($author->id, $request->validated());
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Author $author)
    {
        return $this->authorRepository->delete($author->id);
    }
}
