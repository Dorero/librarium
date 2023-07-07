<?php
namespace App\Repositories;

interface BookRepositoryInterface {
    public function all();

    public function find(int $id);

    public function save(array $params);

    public function update(int $id, array $params);

    public function delete(int $id);
}