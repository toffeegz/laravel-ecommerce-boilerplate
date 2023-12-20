<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UserAddressSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::all();

        foreach ($users as $user) {
            $addresses = $user->addresses()->get();

            if ($addresses->isNotEmpty()) {
                $randomAddress = $addresses->random();
                $user->default_address_id = $randomAddress->id;
                $user->save();
            }
        }
    }
}
