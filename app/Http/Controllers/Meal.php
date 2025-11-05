<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Meal extends Controller
{
    public function create_meal()
    {
        return view('meal.create-meal');
    }

    public function store_meal(Request $request)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'month' => 'required|in:January,February,March,April,May,June,July,August,September,October,November,December',
            'year' => 'required|integer|min:2000|max:2100',
        ]);

        // Here you would typically save the meal data to the database
        $meal = new \App\Models\Meal();
        $meal->month = $validatedData['month'];
        $meal->year = $validatedData['year'];
        $meal->manager = auth()->id(); // Assuming meals are associated with users
        $meal->save();
        // For demonstration purposes, we'll just return a success message

        return redirect()->route('dashboard')->with('success', 'Meal created successfully for ' . $validatedData['month'] . ' ' . $validatedData['year'] . '!');
    }
    
}
