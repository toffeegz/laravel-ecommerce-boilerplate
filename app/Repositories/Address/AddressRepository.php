<?php

namespace App\Repositories\Address;

use App\Models\Address;
use Illuminate\Support\Carbon;
use App\Repositories\Base\BaseRepository;
use Illuminate\Support\Facades\Log;

class AddressRepository extends BaseRepository implements AddressRepositoryInterface
{

    /**
     * AddressRepository constructor.
     *
     * @param Address $model
     */

    public function __construct(Address $model)
    {
        parent::__construct($model);
    }
}
