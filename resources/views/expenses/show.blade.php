@extends('layouts.layout')
@section('content')
@section('title', 'Show expense')

@include('expenses.shared.back-button')
<div>
    <h1>View expense Details</h1>
    <hr>
    <div class="row ">
        <div class="card text-bg-dark mb-3 me-3" style="max-width: 20rem;">
            <div class="card-header fs-3 fw-bold">{{ $expense->expenseTitle }}</div>
            <div class="card-body">
                <h5 class="card-title fs-4"> <span class="fw-bold">Amount:</span>
                    ₱{{ number_format($expense->expenseAmount, 2) }}
                </h5>
                <h5 class="card-title fs-4"> <span class="fw-bold">Category: </span>{{ $expense->expenseCategory }}

                    <p class="card-text"><span class="fw-bold">Description:</span> {{ $expense->expenseDescription }}</p>
                    <p class="card-text"><span class="fw-bold">Date Created:</span> {{ $expense->created_at }}</p>
            </div>
        </div>
        <div class="card text-bg-dark mb-3 me-3" style="max-width: 20rem;">
            <div class="card-header fs-3"><span class="fw-bold">More Details</div>
            <div class="card-body">
                <h5 class="card-title fs-4"> <span class="fw-bold">Total Expenses Before:</span>
                    ₱{{ number_format($expense->expenseOldSum, 2) }}
                </h5>
                <h5 class="card-title fs-4"> <span class="fw-bold">Added:</span>
                    ₱{{ number_format($expense->expenseAmount, 2) }}
                </h5>
                <h5 class="card-title fs-4"> <span class="fw-bold">New Total Expenses:</span>
                    ₱{{ number_format($expense->expenseNewSum, 2) }}
                </h5>
                <h5 class="card-title fs-4"> <span class="fw-bold">Balance:</span>
                    ₱{{ number_format($expense->balance, 2) }}
                </h5>
            </div>
        </div>
    </div>
</div>
@endsection
