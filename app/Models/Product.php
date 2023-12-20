<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\Uuid;

class Product extends Model
{
    use HasFactory, SoftDeletes, Uuid;

    protected $fillable = [
        'name',
        'description',
        'is_available',
        'price',
        'discount',
        'quantity',
        'product_type_id',
        'created_by',
    ];

    public function scopeFilter($query, array $filters)
    {
        $search = $filters['search'] ?? false;
        $query
            ->when($filters['search'] ?? false, 
            function($query) use($search) {
                $query->where(function($query) use($search) {
                    $query->where('name', 'like', '%' . $search . '%')
                        ->orWhere('description', 'like', '%' . $search . '%')
                        ->orWhere('contact_no', 'like', '%' . $search . '%')
                        ->orWhereHas('createdBy', function ($subQuery) use ($search) {
                            $subQuery->where('name', 'like', '%' . $search . '%');
                        });
                });
            }
        );
    }

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
