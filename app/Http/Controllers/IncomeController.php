<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Income;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class IncomeController extends Controller
{
    public function index()

    {
        $categories = Category::where(
            [
                ['user_id', Auth::user()->id],
                ['categoryType', 1],
            ]
        )->get();
        $incomes = Income::latest()->where('user_id', '=', Auth::user()->id);

        if (request()->has('search')) {
            $incomes = $incomes->orderBy('incomeTitle', 'ASC')->where('incomeTitle', 'like', '%' . request('search', '') . '%')->orWhere('incomeAmount', 'like', '%' . request('search', '') . '%');
        }

        if (request()->has('category')) {
            $incomes = $incomes->orderBy('incomeTitle', 'ASC')->where('incomeCategory', 'like', '%' . request('category', '') . '%');
        }


        return view('incomes/index', ['incomes' => $incomes->paginate(5), 'categories' => $categories]);
    }

    public function create(Category $categories)
    {
        $categories = Category::where('categoryType', '=', 1)->orderBy('categoryName', 'asc')->get();

        // dd($categories);
        return view('incomes.create', ['categories' => $categories]);
    }

    public function store()
    {
        $validated = request()->validate([
            'incomeTitle' => 'required|min:5|max:225',
            'incomeDescription' => 'required|min:5|max:225',
            'incomeAmount' => 'required|numeric',
            'incomeCategory' => 'required',
        ]);
        $validated['user_id'] = Auth::id();
        $validated['incomeOldSum'] = Auth::user()->income->sum('incomeAmount');
        $validated['incomeNewSum'] = Auth::user()->income->sum('incomeAmount') + $validated['incomeAmount'];
        $validated['user_id'] = Auth::id();


        Income::create([
            'incomeTitle' => $validated['incomeTitle'],
            'incomeDescription' => $validated['incomeDescription'],
            'incomeAmount' => $validated['incomeAmount'],
            'incomeOldSum' => $validated['incomeOldSum'],
            'incomeNewSum' => $validated['incomeNewSum'],
            'incomeCategory' => $validated['incomeCategory'],
            'user_id' => $validated['user_id'],
        ]);

        return redirect()->route('incomes.index')->withErrors('message')->with('message', 'Income Entry Added!');
    }

    public function show(Income $income)
    {
        return view('incomes.show', ['income' => $income]);
    }

    public function edit(Income $income)
    {
        $categories = Category::where('categoryType', '=', 1)->orderBy('categoryName', 'asc')->get();
        return view('incomes.edit', ['income' => $income, 'categories' => $categories]);
    }

    public function update(Income $income)
    {



        $validated = request()->validate([
            'incomeTitle' => 'required|min:5|max:20',
            'incomeDescription' => 'required|min:10|max:225',
            'incomeAmount' => 'required|numeric',
            'incomeCategory' => 'required',
        ]);

        $income->update([
            'incomeTitle' => $validated['incomeTitle'],
            'incomeDescription' => $validated['incomeDescription'],
            'incomeAmount' => $validated['incomeAmount'],
            'incomeCategory' => $validated['incomeCategory'],
        ]);

        return redirect()->route('incomes.show', $income)->withErrors('message')->with('message')->with('message', 'Update Income Entry Successfully!');
    }

    public function destroy(Income $income)
    {
        $income->delete();

        return redirect()->route('incomes.index')->with('message', 'Income Entry Deleted!');
    }
}
