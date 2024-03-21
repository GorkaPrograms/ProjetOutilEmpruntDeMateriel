<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'user',
        'status',
        'comback_date',
        'updated_at',
        'created_at',
    ];

    public function rentables() {
        return $this->belongsToMany(Rentable::class, "locations", "order_reference", "rentable")
            ->withPivot('quantity');
    }

    public function user() {
        return $this->belongsTo(User::class, 'user');
    }
}
