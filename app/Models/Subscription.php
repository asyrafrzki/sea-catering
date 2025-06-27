<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    protected $fillable = [
        'user_id',
        'name',
        'phone',
        'plan',
        'meal_types',
        'days',
        'allergies',
        'total_price',
    ];
}

