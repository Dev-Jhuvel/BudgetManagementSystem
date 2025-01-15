@extends('layouts.layout')
@section('title', 'Dashboard')
@section('content')
    <div>
        <div class="d-md-flex justify-content-between align-items-center">
            <div>
                <h1>Dashboard</h1>
            </div>
            <div>
                <a href="{{ route('dashboard.overview') }}" class="btn btn-primary">Overview</a>
            </div>
        </div>
        <hr>
        <div class="d-flex justify-content-around c-row mb-3">

            <div class="p-3 bg-dark text-white text-center border border-white">
                <h3>Total Income</h3>
                <h4>₱{{ number_format($incomeSum, 2) }}</h4>
            </div>
            <div class="p-3 bg-dark text-white text-center border border-white">
                <h3>Total Expenses</h3>
                <h4>₱{{ number_format($expenseSum, 2) }}</h4>
            </div>
            <div class="p-3 bg-dark text-white text-center border border-white">
                <h3>Remaining Budget</h3>
                <h4>₱{{ number_format($balance, 2) }}</h4>
            </div>
        </div>
        <div class="card bg-transparent" style="max-width: 400px">
            <h1 class="card-header text-center">Expenses</h1>
            <canvas class="fs-1" id="ExpensesChart"></canvas>
        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        var dataValues = @json(array_values($expenseArray));
        var dataKeys = @json(array_keys($expenseArray));

        const ctx = document.getElementById('ExpensesChart');

        const data = {
            labels: dataKeys,
            datasets: [{
                label: 'My First Dataset',
                data: dataValues,
                hoverOffset: 4
            }]
        };
        new Chart(ctx, {
            type: 'pie',
            data: data,
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>




@endsection
