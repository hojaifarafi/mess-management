<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Meal;
use App\Models\User;

class MealCount extends Model
{
    protected $guarded = [];
    protected $primaryKey = ['meal_id', 'user_id'];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function meal()
    {
        return $this->belongsTo(Meal::class);
    }
}
