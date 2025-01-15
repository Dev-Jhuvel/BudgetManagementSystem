<form method="get" action="{{ route('expenses.index') }}" class="d-flex col-4 mb-3" role="search">
    <select class="form-select me-2" name="category" aria-label="Default select example">
        <option disabled selected>Select Category</option>
        @foreach ($categories as $category)
            <option value="{{ $category->categoryName }}">{{ $category->categoryName }}</option>
        @endforeach
    </select>
    <input class="btn btn-outline-success" type="submit" value="Filter"></input>
</form>

<form method="get" action="{{ route('expenses.index') }}" class="d-flex col-4 mb-3" role="filter">
    <input class="form-control me-2" name="search" type="search" placeholder="Search" aria-label="Search">
    <input class="btn btn-outline-success" type="submit" value="Search"></input>
</form>
