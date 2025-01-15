<nav class="navbar navbar-dark navbar-expand-lg bg-dark fs-5 px-2">
    <div class="container-fluid">
        @guest
            <a class="navbar-brand fw-bold fs-3" href="/">TipidApp</a>
        @endguest
        @auth
            <a class="navbar-brand fw-bold fs-3" href="{{ route('dashboard') }}">TipidApp</a>

        @endauth
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown"
            aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse c-row" id="navbarNavDropdown">
            <ul class="navbar-nav">
                @auth()
                    <li class="nav-item">
                        <a class="nav-link {{ Route::is('dashboard') ? 'active  ' : '' }}"
                            href="{{ route('dashboard') }}">Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Route::is('income') ? 'active  ' : '' }}"
                            href="{{ route('incomes.index') }}">Income</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Route::is('expenses') ? 'active  ' : '' }}"
                            href="{{ route('expenses.index') }}">Expense</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Route::is('categories') ? 'active  ' : '' }}"
                            href="{{ route('categories.index') }}">Categories</a>
                    </li>
                @endauth
            </ul>
            <ul class="navbar-nav">
                @guest()
                    <li class="nav-item me-1">
                        <a class="nav-link btn {{ Route::is('login') ? 'active  btn-primary btn-sm' : 'btn-secondary btn-sm' }}"
                            href="{{ route('login') }}">Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link btn {{ Route::is('register') ? 'active  btn-primary btn-sm' : 'btn-secondary btn-sm' }}"
                            href="{{ route('register') }}">Register</a>
                    </li>
                @endguest

                @auth
                </ul>
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link text-white"><strong>Balance:</strong>
                            {{ ' ₱' . number_format(Auth::user()->income->sum('incomeAmount') - Auth::user()->expense->sum('expenseAmount'), 2) }}
                        </a>
                    </li>
                </ul>

                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link {{ Route::is('register') ? 'active  btn-primary btn-sm' : 'btn-secondary btn-sm' }}"
                            href="/">{{ Str::ucfirst(Str::lower(Auth::user()->name)) }}</a>
                    </li>
                    <form action="{{ route('logout') }}" method="post">
                        @csrf
                        @method('post')
                        <input class="nav-link  " type="submit" value="Logout">
                    </form>
                @endauth
            </ul>
        </div>
    </div>
</nav>
