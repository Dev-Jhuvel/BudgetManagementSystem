@extends('layouts.layout')
@section('content')
@section('title', 'Edit Income')

@include('incomes.shared.back-button')
<h1>Edit Income</h1>
<hr>
<form action="{{ route('incomes.show', $income->id) }}" method="POST">
    @csrf
    @method('PUT')
    <div class="row">
        <div class="col">
            <div class="col">
                <label class="form-label fs-4">Title</label>
                <input type="text" name="incomeTitle" class="form-control" value="{{ $income->incomeTitle }}"
                    placeholder="ex.Family Allowance">
                @error('incomeTitle')
                    <span class="d-block fs-6 text-danger mt-2">{{ $message }}</span>
                @enderror
            </div>
            <div class="col">
                <label class="form-label fs-4">Description</label>
                <textarea name="incomeDescription" class="form-control" cols="30 rows="10">{{ $income->incomeDescription }}</textarea>
                @error('incomeDescription')
                    <span class="d-block fs-6 text-danger mt-2">{{ $message }}</span>
                @enderror
            </div>
        </div>
        <div class="col">
            <div class="col">
                <label class="form-label fs-4">Amount</label>
                <input type="number" name="incomeAmount" class="form-control" value="{{ $income->incomeAmount }}"
                    placeholder="2000.00">
                @error('incomeAmount')
                    <span class="d-block fs-6 text-danger mt-2">{{ $message }}</span>
                @enderror
            </div>
            <div class="col">
                <label class="form-label fs-4">Category</label>
                <select class="form-select" name="incomeCategory" aria-label="Default select example">
                    <option disabled selected>Select Category</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->categoryName }}"
                            {{ $income->incomeCategory === $category->categoryName ? 'selected' : '' }}>
                            {{ $category->categoryName }}
                        </option>
                    @endforeach
                </select>
                @error('incomeCategory')
                    <span class="d-block fs-6 text-danger mt-2">{{ $message }}</span>
                @enderror
            </div>
        </div>
    </div>
    <input class="btn btn-dark mt-3"type="submit" value="Update Income">

</form>
@endsection
