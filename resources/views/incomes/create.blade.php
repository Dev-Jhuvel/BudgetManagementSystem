@extends('layouts.layout')
@section('content')
@section('title', 'Add Income')

@include('incomes.shared.back-button')
<h1>Add Income</h1>
<hr>
<form action="{{ route('incomes.index') }}" method="post" class="row g-3 needs-validation">
    @csrf
    @method('post')
    <div class="col-md">
        <div class="col-md">
            <label class="form-label fs-4">Title</label>
            <input type="text" name="incomeTitle" value="{{ old('incomeTitle') }}" class="form-control" id=""
                placeholder="ex.Family Allowance">
            @error('incomeTitle')
                <span class="d-block fs-6 text-danger mt-2">{{ $message }}</span>
            @enderror
        </div>
        <div class="col-md">
            <label class="form-label fs-4">Description</label>
            <textarea name="incomeDescription" class="form-control" cols="30 rows="10">{{ old('incomeDescription') }}</textarea>
            @error('incomeDescription')
                <span class="d-block fs-6 text-danger mt-2">{{ $message }}</span>
            @enderror
        </div>
    </div>
    <div class="col-md">

        <div class="col-md">
            <label class="form-label fs-4">Amount</label>
            <input type="number" value="{{ old('incomeAmount') }}" name="incomeAmount" class="form-control"
                id="" placeholder="2,000.00">
            @error('incomeAmount')
                <span class="d-block fs-6 text-danger mt-2">{{ $message }}</span>
            @enderror
        </div>
        <div class="col-md">
            <label class="form-label fs-4">Category</label>
            <select class="form-select" name="incomeCategory" aria-label="Default select example">
                <option disabled selected>Select Category</option>
                @foreach ($categories as $category)
                    <option {{ old('incomeCategory') === $category->categoryName ? 'selected' : '' }}
                        value="{{ $category->categoryName }}">{{ $category->categoryName }}</option>
                @endforeach
            </select>
            @error('incomeCategory')
                <span class="d-block fs-6 text-danger mt-2">{{ $message }}</span>
            @enderror
        </div>
    </div>
    <div class="col-12">
        <input class="btn btn-dark mt-3"type="submit" value="Add Income">
    </div>

</form>
@endsection
