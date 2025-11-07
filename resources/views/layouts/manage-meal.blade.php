<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('styles')
    <title>{{$title ?? 'Manage Meal'}}</title>
</head>
<body>
    <header>
        <nav class="w-fit mx-auto mb-2 bg-blue-100 rounded-lg shadow-md my-1 sticky top-0" style="padding: 1px;">
            <ul class="flex gap-4 my-3" >
                <li><a href="{{ route('meal.manage', $meal->id) }}" class="@if(request()->routeIs('meal.manage')) font-bold bg-blue-700 rounded-lg text-white @endif p-3">Meal Sheet</a></li>
                <li><a href="#" class="@if(request()->routeIs('dashboard')) font-bold bg-blue-700 rounded-lg text-white @endif p-3 ">Deposit</a></li>
                <li><a href="#" class="@if(request()->routeIs('dashboard')) font-bold bg-blue-700 rounded-lg text-white @endif p-3 ">Service</a></li>
                <li><a href="#" class="@if(request()->routeIs('dashboard')) font-bold bg-blue-700 rounded-lg text-white @endif p-3 ">Bazar</a></li>
                <li><a href="#" class="@if(request()->routeIs('dashboard')) font-bold bg-blue-700 rounded-lg text-white @endif p-3 ">Report</a></li>
                <li><a href="{{ route('meal.members', $meal->id) }}" class="@if(request()->routeIs('meal.settings') || request()->routeIs('meal.members')) font-bold bg-blue-700 rounded-lg text-white @endif p-3 ">Settings</a></li>
            </ul>
        </nav>
    </header>
    <main>
        @yield('content')
    </main>
    @stack('scripts')
</body>
</html>