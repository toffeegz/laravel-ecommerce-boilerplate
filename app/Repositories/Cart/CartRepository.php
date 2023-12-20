<?php

namespace App\Repositories\Cart;

use App\Models\Cart;
use Illuminate\Support\Carbon;
use App\Repositories\Base\BaseRepository;
use Illuminate\Support\Facades\Log;

class CartRepository extends BaseRepository implements CartRepositoryInterface
{

    /**
     * CartRepository constructor.
     *
     * @param Cart $model
     */

    public function __construct(Cart $model)
    {
        parent::__construct($model);
    }

    public function index(array $search = [], array $relations = [], string $sortByColumn = 'created_at', string $sortBy = 'DESC')
    {
        $user = auth()->user();
        if($user) {
            $this->model = $this->model->where('user_id', $user->id);
        }
        
        if($relations) {
            $this->model = $this->model->with($relations);
        }

        return $this->model->filter($search)->orderBy($sortByColumn, $sortBy)->paginate(request('limit') ?? 10);
    }
}
