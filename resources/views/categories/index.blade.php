@extends('layouts.layout')
@section('title', 'Manage Category')
@section('content')
    <h1 class="mb-3">Add Category</h1>
    <hr>
    <form action="{{ route('categories.index') }}" method="post" class="row">
        @csrf
        @method('post')
        <div class="col-md-5">
            <label class="form-label fs-4">Cateory Name</label>
            <input type="text" name="categoryName" class="form-control" id="" placeholder="ex.Salary, Bills">
            @error('categoryName')
                <span class="d-block fs-6 text-danger mt-2">{{ $message }}</span>
            @enderror
        </div>

        <div class="col-md-5">
            <label class="form-label fs-4">Type</label>
            <select class="form-select" name="categoryType" aria-label="Default select example">
                <option value="1">Income</option>
                <option value="2">Expense</option>
            </select>
            @error('categoryType')
                <span class="d-block fs-6 text-danger mt-2">{{ $message }}</span>
            @enderror
        </div>
        <div class="col pt-4 mt-3">
            <input type="submit" value="Add Category" class="form-input btn btn-dark">
        </div>
    </form>
    <hr>
    <h1 class="mb-3">Manage Category</h1>
    <div class="row  ">
        @include('categories.shared.search')
    </div>

    <table class="table table-hover">
        <thead class="table-dark">
            <tr>
                {{-- <th>Date</th> --}}
                <th>Id</th>
                <th>Name</th>
                <th>Type</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($categories as $index => $category)
                <tr>
                    {{-- <td>{{ date_format($category->created_at, 'F d, Y') }} </td> --}}
                    <td>{{ $index + 1 }} </td>
                    <td>{{ $category->categoryName }} </td>
                    <td>{{ $category->categoryType === 1 ? 'Income' : 'Expense' }} </td>
                    <td>
                        <form action="{{ route('categories.destroy', $category->id) }}" method="post">
                            @csrf
                            @method('delete')
                            <input type="submit" value="Delete" class="btn btn-danger">
                        </form>
                    </td>
                </tr>
            @empty
                <h1 class="text-center">No Data</h1>
            @endforelse
        </tbody>
    </table>
    {{ $categories->withQueryString()->links('pagination::bootstrap-5') }}
@endsection
