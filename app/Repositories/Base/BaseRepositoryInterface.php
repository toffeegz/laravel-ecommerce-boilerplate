<?php

namespace App\Repositories\Base;

interface BaseRepositoryInterface
{
    public function lists(array $search = [], array $relations = [], string $sortByColumn = 'created_at', string $sortBy = 'DESC');
    public function show(string $id, $with = []);
    public function update(array $params, string $id);
    public function create(array $params);
    public function delete(string $id);
}
