@extends('layouts.manage-meal')
@section('content')
<div class="flex">
    <ul class="flex flex-col text-xl bg-blue-100 text-black shadow-md h-fit"
     style="margin-top: 30vh;border-top-right-radius: 10px; border-bottom-right-radius: 10px;">
        <li class="py-4 px-6 cursor-pointer @if (request()->routeIs('meal.members', $meal->id)) bg-blue-400 rounded-lg @endif"
            onclick="window.location.href = '{{route('meal.members',['id'=>$meal->id])}}'">Members</li>
        <li class="py-4 px-6 cursor-pointer @if (request()->routeIs('meal.settings', $meal->id)) bg-blue-400 rounded-lg @endif"
            onclick="window.location.href = '{{route('meal.settings',['id'=>$meal->id])}}'">Meal</li>
    </ul>
    <div class="ml-6 flex-1">
        <div>
            @session('success')
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4 text-center w-1/2 mx-auto my-4" role="alert">
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endsession
            @yield('settings-content')
        </div>
    </div>
</div>
@endsection