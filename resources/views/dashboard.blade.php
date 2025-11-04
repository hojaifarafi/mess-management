<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="flex justify-between">
                    <h2 class="text-xl">Your Managed Meals</h2>
                    <a href="#" class="text-white hover:bg-blue-700 float-end bg-blue-500 rounded-lg px-4 py-2">Create New Meal</a>
                    </div>
                    <div class="inline-flex flex-wrap gap-4 mt-4">
                        <x-meal-card />
                        <x-meal-card />
                        <x-meal-card />
                        <x-meal-card />
                        <x-meal-card />
                        <x-meal-card />
                        <x-meal-card />
                        <x-meal-card />
                        <x-meal-card />
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
