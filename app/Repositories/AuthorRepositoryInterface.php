<?php

namespace App\Repositories;

interface AuthorRepositoryInterface {
    public function all($limit);

    public function find(int $id);

    public function create(array $data);

    public function update(int $id, array $data);

    public function delete(int $id);
} 
