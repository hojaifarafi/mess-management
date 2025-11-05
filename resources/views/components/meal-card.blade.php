<!-- Smile, breathe, and go slowly. - Thich Nhat Hanh -->
<div class="size-40 bg-blue-50 rounded-lg p-5 shadow-md hover:shadow-lg transition-shadow duration-300 hover:scale-105 cursor-pointer"
onclick="window.location.href = '#'">
    <h3>{{ $meal->month }}</h3>
    <h3>{{ $meal->year }}</h3>
    <p class="text-gray-500">Managed by:</p>
    <p>{{ $meal->manager_info->name }}</p>
</div>