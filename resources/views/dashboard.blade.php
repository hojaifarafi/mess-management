<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
    @session('success')
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4 text-center w-2/3 mx-auto my-4" role="alert">
            <span class="block sm:inline">{{ session('success') }}</span>
        </div>
    @endsession
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h2 class="text-xl">Your Meals</h2>
                    <div class="inline-flex flex-wrap gap-4 mt-4">
                        @foreach($meals as $meal)
                            <x-meal-card :meal="$meal" />
                        @endforeach
                    </div>
                    <div class="flex justify-between mt-6">
                    <h2 class="text-xl">Your Managed Meals</h2>
                    <a href="{{route('meal.create')}}" class="text-white hover:bg-blue-700 float-end bg-blue-500 rounded-lg px-4 py-2">Create New Meal</a>
                    </div>
                    <div class="inline-flex flex-wrap gap-4 mt-4">
                        @foreach($meals as $meal)
                            <x-meal-card :meal="$meal" />
                        @endforeach
                    </div>
                    {{-- Calculation for individual meal costs --}}
                    
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
