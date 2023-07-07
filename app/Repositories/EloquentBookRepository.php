<?php
namespace App\Repositories;

use App\Models\Book;
use App\Repositories\BookRepositoryInterface;

class EloquentBookRepository implements BookRepositoryInterface
{
    public function all()
    {
        return Book::all();
    }

    public function save(array $params)
    {
        return Book::create($params);
    }

    public function find(int $id)
    {
        return Book::find($id);
    }

    public function update(int $id, array $params)
    {
        $book = Book::find($id);
        if ($book) {
            $book->update($params);
        }

        return $book;
    }

    public function delete(int $id)
    {
        return Book::destroy($id);
    }
}