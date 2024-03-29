<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    use HasFactory;

    public function rentable()
    {
        return $this->belongsTo(Rentable::class, 'rentable');
    }

    protected $fillable = [
        'order_reference',
        'status',
        'updated_at',
        'created_at',
    ];


}
