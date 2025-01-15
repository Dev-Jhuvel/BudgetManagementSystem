@extends('layouts.layout')
@section('title', 'Dashboard Overview')
@section('content')
    <div>
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h1>Dashboard Overview</h1>
            </div>
            <div>
                <a href="{{ route('dashboard') }}" class="btn btn-primary">Dashboard</a>
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col">
                <h1 class="fw-bold">Income Breakdown</h1>
                <hr class="border border-success border-2 opacity-50">
                @foreach ($incomeByCategories as $incomeByCategory)
                    <h1><span class="fw-bold"> {{ $incomeByCategory->incomeCategory }}:</span> ₱
                        {{ number_format($incomeByCategory->SUM, 2) }} </h1>
                    <hr>
                @endforeach
            </div>
            <div class="col">   
                <h1 class="fw-bold">Expenses Breakdown</h1>
                <hr class="border border-danger border-2 opacity-50">
                @foreach ($expenseByCategories as $expenseByCategory)
                    <h1><span class="fw-bold">{{ $expenseByCategory->expenseCategory }}:</span>
                        ₱{{ number_format($expenseByCategory->SUM, 2) }}
                    </h1>
                    <hr>
                @endforeach
            </div>
        </div>
    </div>



@endsection
