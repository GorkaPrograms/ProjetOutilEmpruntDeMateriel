<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rentable extends Model
{
    use HasFactory;

    protected $attributes = [
        'rentable_type',
    ];
}