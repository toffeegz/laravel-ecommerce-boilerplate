<?php

namespace App\Repositories\Order;

use App\Models\Order;
use Illuminate\Support\Carbon;
use App\Repositories\Base\BaseRepository;
use Illuminate\Support\Facades\Log;

class OrderRepository extends BaseRepository implements OrderRepositoryInterface
{

    /**
     * OrderRepository constructor.
     *
     * @param Order $model
     */

    public function __construct(Order $model)
    {
        parent::__construct($model);
    }
}
