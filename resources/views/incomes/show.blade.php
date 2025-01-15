@extends('layouts.layout')
@section('content')
@section('title', 'Show Income')

@include('incomes.shared.back-button')
<div>
    <h1>View Income Details</h1>
    <hr>
    <div class="row ">
        <div class="card text-bg-dark mb-3 me-3" style="max-width: 20rem;">
            <div class="card-header fs-3 fw-bold">{{ $income->incomeTitle }}</div>
            <div class="card-body">
                <h5 class="card-title fs-4"> <span class="fw-bold">Amount:</span>
                    ₱{{ number_format($income->incomeAmount, 2) }}
                </h5>
                <h5 class="card-title fs-4"> <span class="fw-bold">Category: </span>{{ $income->incomeCategory }}

                    <p class="card-text"><span class="fw-bold">Description:</span> {{ $income->incomeDescription }}</p>
                    <p class="card-text"><span class="fw-bold">Date Created:</span> {{ $income->created_at }}</p>
            </div>
        </div>
        <div class="card text-bg-dark mb-3 me-3" style="max-width: 20rem;">
            <div class="card-header fs-3"><span class="fw-bold">More Details</div>
            <div class="card-body">
                <h5 class="card-title fs-4"> <span class="fw-bold">Total Before:</span>
                    ₱{{ number_format($income->incomeOldSum, 2) }}
                </h5>
                <h5 class="card-title fs-4"> <span class="fw-bold">Added:</span>
                    ₱{{ number_format($income->incomeAmount, 2) }}
                </h5>
                <h5 class="card-title fs-4"> <span class="fw-bold">New Total:</span>
                    ₱{{ number_format($income->incomeNewSum, 2) }}
                </h5>
            </div>
        </div>
    </div>
</div>
@endsection
