<?php

namespace App\Repositories\User;

use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Carbon;
use App\Repositories\Base\BaseRepository;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;

class UserRepository extends BaseRepository implements UserRepositoryInterface
{

    /**
     * UserRepository constructor.
     *
     * @param User $model
     */

    public function __construct(User $model)
    {
        parent::__construct($model);
    }

    public function edit(array $attributes)
    {
        if(isset($attributes['password'])) {
            $attributes['password'] = Hash::make($attributes['password']);
        }
        $results = $this->update($attributes);
    }

    public function getByEmail(string $email)
    {
        return $this->model->where('email', $email)->first();
    }

    public function promoteToAdmin(array $attributes, string $id): ?User
    {
        $user = $this->model->findOrFail($id);
        $user->update(['role_id' => Role::ADMINISTRATOR_ID]); 

        return $user;
    }
}
