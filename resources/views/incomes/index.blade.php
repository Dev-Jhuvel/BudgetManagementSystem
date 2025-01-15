@extends('layouts.layout')
@section('title', 'Manage Income')
@section('content')

    <h1 class="mb-3">Manage Income</h1>
    <hr>
    <div class="row">
        <div class="col">
            <a href="{{ route('incomes.create') }}" class="btn btn-dark mb-3">Add Income Entry</a>
        </div>
        @include('incomes.shared.search')
    </div>
    <table class="table table-hover">
        <thead class="table-dark">
            <tr>
                <th>Date</th>
                <th>Title</th>
                <th>Amount</th>
                <th>Category</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($incomes as $income)
                <tr>
                    <td>{{ date_format($income->created_at, 'F d, Y') }} </td>
                    <td>{{ $income->incomeTitle }} </td>
                    <td>{{ '₱' . number_format($income->incomeAmount, 2) }} </td>
                    <td>{{ $income->incomeCategory }} </td>
                    <td>
                        <form action="{{ route('incomes.destroy', $income->id) }}" method="post">
                            @csrf
                            @method('delete')
                            <a href="{{ route('incomes.show', $income->id) }}" class="btn btn-primary">View</a>
                            <a href="{{ route('incomes.edit', $income->id) }}" class="btn btn-success">Edit</a>
                            <input type="submit" value="Delete" class="btn btn-danger">
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <h1 class="text-center">No Data</h1>
                </tr>
            @endforelse
        </tbody>
    </table>
    {{ $incomes->withQueryString()->links('pagination::bootstrap-5') }}
@endsection
