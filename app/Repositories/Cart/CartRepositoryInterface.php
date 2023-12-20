<?php

namespace App\Repositories\Cart;

use App\Repositories\Base\BaseRepositoryInterface;

interface CartRepositoryInterface extends BaseRepositoryInterface
{
    public function index(array $search = [], array $relations = [], string $sortByColumn = 'created_at', string $sortBy = 'DESC');
}
