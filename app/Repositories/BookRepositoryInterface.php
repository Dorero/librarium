<?php
namespace App\Repositories;

interface BookRepositoryInterface {
    public function all(int $limit);

    public function find(int $id);

    public function create(array $params);

    public function update(int $id, array $params);

    public function delete(int $id);
}