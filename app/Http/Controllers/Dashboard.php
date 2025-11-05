<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Dashboard extends Controller
{
    public function index()
    {
        $meals = \App\Models\Meal::where('manager', auth()->id())->get();
        return view('dashboard', compact('meals'));
    }
}
