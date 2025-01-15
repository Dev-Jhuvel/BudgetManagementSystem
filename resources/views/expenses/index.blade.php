@extends('layouts.layout')
@section('title', 'Manage expense')
@section('content')
    <h1 class="mb-3">Manage Expenses</h1>
    <hr>
    <div class="row">
        <div class="col">
            <a href="{{ route('expenses.create') }}" class="btn btn-dark mb-3">Add Expense Entry</a>
        </div>
        @include('expenses.shared.search')
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
            @forelse ($expenses as $expense)
                <tr>
                    <td>{{ date_format($expense->created_at, 'F d, Y') }} </td>
                    <td>{{ $expense->expenseTitle }} </td>
                    <td>{{ '₱' . number_format($expense->expenseAmount, 2) }} </td>
                    <td>{{ $expense->expenseCategory }} </td>
                    <td>

                        <form action="{{ route('expenses.destroy', $expense->id) }}" method="post">
                            @csrf
                            @method('delete')
                            <a href="{{ route('expenses.show', $expense->id) }}" class="btn btn-primary">View</a>
                            <a href="{{ route('expenses.edit', $expense->id) }}" class="btn btn-success">Edit</a>
                            <input type="submit" value="Delete" class="btn btn-danger">
                        </form>
                    </td>
                </tr>
            @empty
                <h1 class="text-center">No Data</h1>
            @endforelse
        </tbody>
    </table>
    {{ $expenses->withQueryString()->links('pagination::bootstrap-5') }}
@endsection
