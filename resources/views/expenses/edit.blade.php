@extends('layouts.layout')
@section('content')
@section('title', 'Edit expense')

@include('expenses.shared.back-button')
<h1>Edit Expense</h1>
<hr>
<form action="{{ route('expenses.show', $expense->id) }}" method="POST">
    @csrf
    @method('PUT')
    <div class="row">
        <div class="col">
            <div class="col">
                <label class="form-label fs-4">Title</label>
                <input type="text" name="expenseTitle" class="form-control" value="{{ $expense->expenseTitle }}"
                    placeholder="ex.Family Allowance">
                @error('expenseTitle')
                    <span class="d-block fs-6 text-danger mt-2">{{ $message }}</span>
                @enderror
            </div>
            <div class="col">
                <label class="form-label fs-4">Description</label>
                <textarea name="expenseDescription" class="form-control" cols="30 rows="10">{{ $expense->expenseDescription }}</textarea>
                @error('expenseDescription')
                    <span class="d-block fs-6 text-danger mt-2">{{ $message }}</span>
                @enderror
            </div>
        </div>
        <div class="col">
            <div class="col">
                <label class="form-label fs-4">Amount</label>
                <input type="number" name="expenseAmount" class="form-control" value="{{ $expense->expenseAmount }}"
                    placeholder="2000.00">
                @error('expenseAmount')
                    <span class="d-block fs-6 text-danger mt-2">{{ $message }}</span>
                @enderror
            </div>
            <div class="col">
                <label class="form-label fs-4">Category</label>
                <select class="form-select" name="expenseCategory" aria-label="Default select example">
                    <option disabled selected>Select Category</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->categoryName }}"
                            {{ $expense->expenseCategory === $category->categoryName ? 'selected' : '' }}>
                            {{ $category->categoryName }}
                        </option>
                    @endforeach
                </select>
                @error('expenseCategory')
                    <span class="d-block fs-6 text-danger mt-2">{{ $message }}</span>
                @enderror
            </div>
        </div>
    </div>
    <input class="btn btn-dark mt-3"type="submit" value="Update Expense">

</form>
@endsection
