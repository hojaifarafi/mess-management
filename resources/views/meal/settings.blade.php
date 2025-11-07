@extends('layouts.meal-settings')
@section('settings-content')
    <h1 class="text-2xl font-bold text-center px-5">Meal Settings for {{ $meal->month }} {{ $meal->year }}</h1>
    
    <!-- Add your meal settings content here -->
    <hr class="my-5 w-3/5 mx-auto">
    <form action="{{ route('meal.update', ['id' => $meal->id]) }}" method="POST" class="mt-4 w-1/2 mx-auto bg-white p-6 rounded-lg shadow-md">
        @csrf
        @method('PUT')
        <div class="mb-4">
            <label for="month" class="block text-gray-700">Month:</label>
            <select id="month" name="month" class="w-full px-3 py-2 border rounded-lg">
                @foreach (['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'] as $month)
                    <option value="{{ $month }}" @if ($meal->month === $month) selected @endif>{{ $month }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-4">
            <label for="year" class="block text-gray-700">Year:</label>
            <select id="year" name="year" class="w-full px-3 py-2 border rounded-lg">
                @for ($year = date('Y'); $year <= date('Y') + 1; $year++)
                    <option value="{{ $year }}" @if ($meal->year == $year) selected @endif>{{ $year }}</option>
                @endfor
            </select>
        </div>
        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-700">Update Meal</button>
    </form>
    <hr class="my-5 w-3/5 mx-auto">
    <div class="mx-auto mt-10 w-1/2 bg-white p-6 rounded-lg shadow-md text-center">
        <p class="text-red-500">Deleting meal can not be undone. Be sure to double-check before proceeding.</p>
        <form action="{{ route('meal.destroy', ['id' => $meal->id]) }}" method="POST" class="mt-6 w-1/2 mx-auto text-center">
            @csrf
            @method('DELETE')
            <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded-lg hover:bg-red-700"
            onclick="return confirm('Are you sure you want to delete this meal? This action cannot be undone.');">
                Delete Meal
            </button>
        </form>
    </div>
@endsection