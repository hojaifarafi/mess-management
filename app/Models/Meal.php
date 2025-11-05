<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Meal extends Model
{
    protected $fillable = [
        'month',
        'year',
        'manager',
    ];
    public function manager_info()
    {
        return $this->belongsTo(User::class, 'manager');
    }
}
