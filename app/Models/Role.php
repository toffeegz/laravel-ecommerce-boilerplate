<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\Uuid;

class Role extends Model
{
    use HasFactory, SoftDeletes, Uuid;

    protected $fillable = ['name', 'description'];

    const ADMINISTRATOR_ID = "d74542d0-db3f-4cfb-95b8-205e90c90a9d";
}
