<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MealMember extends Model
{
    protected $fillable = ['sl_no','meal_id', 'user_id', 'short_name'];
    public $incrementing = false;
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
