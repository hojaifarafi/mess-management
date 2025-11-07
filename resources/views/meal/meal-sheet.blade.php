@extends('layouts.manage-meal')
@section('content')
<h1 class="text-2xl font-bold mb-1 text-center">Meal Sheet for {{ $meal->month }} {{ $meal->year }}</h1>
<div class="mx-auto p-4 w-fit">
    <div class="font-semibold header-container">
        <div class="name-container">Name</div>
        <div class="date-container">1</div><div class="date-container">2</div><div class="date-container">3</div><div class="date-container">4</div><div class="date-container">5</div><div class="date-container">6</div><div class="date-container">7</div><div class="date-container">8</div><div class="date-container">9</div><div class="date-container">10</div>
        <div class="date-container">11</div><div class="date-container">12</div><div class="date-container">13</div><div class="date-container">14</div><div class="date-container">15</div><div class="date-container">16</div><div class="date-container">17</div><div class="date-container">18</div><div class="date-container">19</div><div class="date-container">20</div>
        <div class="date-container">21</div><div class="date-container">22</div><div class="date-container">23</div><div class="date-container">24</div><div class="date-container">25</div><div class="date-container">26</div><div class="date-container">27</div><div class="date-container">28</div><div class="date-container">29</div><div class="date-container">30</div><div class="date-container">31</div>
        <div class="total-container">Total</div>
    </div>
    
</div>
@endsection
@push('styles')
<style>
    .header-container {
        display: flex;
        font-weight: bold;
        border: 2px solid #000;
        padding: 0;
        background-color: rgb(250, 226, 179);     
    }
    .date-container {
        text-align: center;
        border-left: 2px solid #000;
        padding: 10px;
        min-width: 50px;
    }
    .name-container{
        text-align: center;
        min-width: 120px;
        padding:10px;
    }
    .total-container{
        text-align: center;
        padding: 10px;
        min-width: 80px;
        border-left: 2px solid #000;
    }
</style>
@endpush