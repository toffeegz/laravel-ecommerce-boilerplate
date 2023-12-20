<?php

namespace App\Repositories\Product;

use App\Models\Product;
use Illuminate\Support\Carbon;
use App\Repositories\Base\BaseRepository;
use Illuminate\Support\Facades\Log;

class ProductRepository extends BaseRepository implements ProductRepositoryInterface
{

    /**
     * ProductRepository constructor.
     *
     * @param Product $model
     */

    public function __construct(Product $model)
    {
        parent::__construct($model);
    }
}
