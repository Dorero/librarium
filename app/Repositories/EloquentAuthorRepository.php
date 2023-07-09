<?php

namespace App\Repositories;
use App\Models\Author;

class EloquentAuthorRepository implements AuthorRepositoryInterface {
    public function all($limit) {
        if($limit == null) $limit = 20;
        if($limit > 50) $limit = 50;

        return Author::orderBy("id")->cursorPaginate($limit);
    }

    public function find(int $id) {
        return Author::find($id);
    }

    public function create(array $data) {
        return Author::create($data);
    }

    public function update(int $id, array $data) {
        $author = Author::find($id);

        if($author) {
            $author->update($data);
        }

        return $author;
    }

    public function delete(int $id) {
        return Author::destroy($id);
    }
}