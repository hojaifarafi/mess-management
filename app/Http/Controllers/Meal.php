<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
    public function manage_meal($id)
    {
        $meal = \App\Models\Meal::findOrFail($id);
        
        return view('meal.meal-sheet', compact('meal'));
    }
    public function meal_settings($id)
    {
        $meal = \App\Models\Meal::findOrFail($id);
        return view('meal.settings', compact('meal'));
    }
    public function meal_members($id)
    {
        $meal = \App\Models\Meal::findOrFail($id);
        $members = \App\Models\MealMember::where('meal_id', $id)->with('user')->orderBy('sl_no')->get();
        return view('meal.members', compact('meal', 'members'));
    }
    public function update_meal(Request $request, $id)
    {
        // Update meal logic here
        $validatedData = $request->validate([
            'month' => 'required|in:January,February,March,April,May,June,July,August,September,October,November,December',
            'year' => 'required|integer|min:2000|max:2100',
        ]);
        $meal = \App\Models\Meal::findOrFail($id);
        $meal->month = $validatedData['month'];
        $meal->year = $validatedData['year'];
        $meal->save();

        return redirect()->route('meal.settings', ['id' => $meal->id])->with('success', 'Meal updated successfully!');
    }
    public function destroy_meal($id)
    {
        $meal = \App\Models\Meal::findOrFail($id);
        $meal->delete();

        return redirect()->route('dashboard')->with('success', 'Meal deleted successfully!');
    }
    public function is_duplicate($id,$short_name)
    {
        $exists = \App\Models\MealMember::where('meal_id', $id)
            ->where('short_name', $short_name)
            ->exists();

        return response()->json(['is_duplicate' => $exists]);
    }
    public function store_member(Request $request, $mealId)
    {
        $validatedData = $request->validate([
            'short_name' => 'required|string|max:50',
        ]);

        $mealMember = new \App\Models\MealMember();
        $mealMember->meal_id = $mealId;
        $mealMember->user_id = $request->user_id;
        $mealMember->short_name = $validatedData['short_name'];
        $mealMember->save();

        return redirect()->route('meal.members', ['id' => $mealId])->with('success', 'Member added successfully!');
    }
    public function search_users(Request $request, $mealId)
    {
        $query = $request->input('query');

        $users = \App\Models\User::where(function ($q) use ($query) {
        $q->where('name', 'LIKE', "%{$query}%")
          ->orWhere('email', 'LIKE', "%{$query}%");
            })->whereNotIn('id', \App\Models\MealMember::where('meal_id', $mealId)->pluck('user_id'))
            ->limit(10)
            ->get();


        return response()->json($users);
    }
    public function remove_member($mealId, $memberId)
    {
        // Problem with ORM delete, so using query builder
        DB::table('meal_members')
            ->where('meal_id', $mealId)
            ->where('user_id', $memberId)
            ->delete();

        return redirect()->route('meal.members', ['id' => $mealId])->with('success', 'Member removed successfully!');
    }
    public function update_member(Request $request, $mealId, $memberId)
    {
        $validatedData = $request->validate([
            'short_name' => 'required|string|max:50',
        ]);

        $mealMember = DB::table('meal_members')
            ->where('meal_id', $mealId)
            ->where('user_id', $memberId)
            ->first();

        $mealMember->short_name = $validatedData['short_name'];
        // Problem with ORM update, so using query builder\
        DB::table('meal_members')
            ->where('meal_id', $mealId)
            ->where('user_id', $memberId)
            ->update(['short_name' => $validatedData['short_name']]);

        return response()->json(['success' => true, 'meal_member' => $mealMember]);
    }
    public function update_member_order(Request $request, $mealId)
    {
        $from_sl_no = $request->input('from_sl_no');
        $to_sl_no = $request->input('to_sl_no');
        $from_user_id = $request->input('from_user_id');
        $to_user_id = $request->input('to_user_id');
        // Swap the sl_no of the two members
        DB::table('meal_members')
            ->where('meal_id', $mealId)
            ->where('user_id', $from_user_id)
            ->update(['sl_no' => $to_sl_no]);
        DB::table('meal_members')
            ->where('meal_id', $mealId)
            ->where('user_id', $to_user_id)
            ->update(['sl_no' => $from_sl_no]);
        return response()->json(['success' => true]);
    }
}
