<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\Uuid;

class Address extends Model
{
    use HasFactory, Uuid, SoftDeletes;

    protected $fillable = [
        'user_id',
        'address',
        'contact_no',
    ];
}
