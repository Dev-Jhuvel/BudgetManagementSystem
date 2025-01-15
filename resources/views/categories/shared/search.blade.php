<form method="get" action="{{ route('categories.index') }}" class="d-flex col-4 mb-3 me-3" role="search">
    <select class="form-select me-2" name="type" aria-label="Default select example">
        <option disabled selected>Select Type</option>
        <option value="1">Income</option>
        <option value="2">Expense</option>
    </select>
    <input class="btn btn-outline-success" type="submit" value="Filter"></input>
</form>

<form method="get" action="{{ route('categories.index') }}" class="d-flex col-4 mb-3" role="filter">
    <input class="form-control me-2" name="search" type="search" placeholder="Search" aria-label="Search">
    <input class="btn btn-outline-success" type="submit" value="Search"></input>
</form>
