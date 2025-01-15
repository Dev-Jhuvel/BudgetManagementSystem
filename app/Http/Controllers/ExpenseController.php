<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Expense;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ExpenseController extends Controller
{
    public function index()
    {
        $categories = Category::where(
            [
                ['user_id', Auth::user()->id],
                ['categoryType', 2],
            ]
        )->get();
        $expenses = Expense::latest()->where('user_id', '=', Auth::user()->id);

        if (request()->has('search')) {
            $expenses = $expenses->orderBy('expenseTitle', 'ASC')->where('expenseTitle', 'like', '%' . request('search', '') . '%')->orWhere('expenseAmount', 'like', '%' . request('search', '') . '%');
        }

        if (request()->has('category')) {
            $expenses = $expenses->orderBy('expenseTitle', 'ASC')->where('expenseCategory', 'like', '%' . request('category', '') . '%');
        }


        return view('expenses/index', ['expenses' => $expenses->paginate(5), 'categories' => $categories]);
    }

    public function create(Category $categories)
    {
        $categories = Category::where('categoryType', '=', 2)->orderBy('categoryName', 'asc')->get();
        return view('expenses.create', ['categories' => $categories]);
    }

    public function store(User $user)
    {
        $balance = Auth::user()->income->sum('incomeAmount') - Auth::user()->expense->sum('expenseAmount');
        $validated = request()->validate([
            'expenseTitle' => 'required|min:5|max:225',
            'expenseDescription' => 'required|min:5|max:225',
            'expenseAmount' => 'required|numeric|lte:' . $balance,
            'expenseCategory' => 'required',
        ]);
        $validated['user_id'] = Auth::id();
        $validated['expenseOldSum'] = Auth::user()->expense->sum('expenseAmount');
        $validated['expenseNewSum'] = Auth::user()->expense->sum('expenseAmount') + $validated['expenseAmount'];

        $validated['balance'] = $balance - $validated['expenseAmount'];


        Expense::create([
            'expenseTitle' => $validated['expenseTitle'],
            'expenseDescription' => $validated['expenseDescription'],
            'expenseAmount' => $validated['expenseAmount'],
            'expenseOldSum' => $validated['expenseOldSum'],
            'expenseNewSum' => $validated['expenseNewSum'],
            'balance' => $validated['balance'],
            'expenseCategory' => $validated['expenseCategory'],
            'user_id' => $validated['user_id'],
        ]);

        return redirect()->route('expenses.index')->withErrors('message')->with('message', 'Expense Entry Added!');
    }

    public function show(expense $expense)
    {
        $balance = Auth::user()->income->sum('incomeAmount') - Auth::user()->expense->sum('expenseAmount');
        return view('expenses.show', ['expense' => $expense, 'balance' => $balance]);
    }

    public function edit(expense $expense)
    {

        $categories = Category::where('categoryType', '=', value: 2)->orderBy('categoryName', 'asc')->get();

        return view('expenses.edit', ['expense' => $expense, 'categories' => $categories]);
    }

    public function update(expense $expense)
    {
        $validated = request()->validate([
            'expenseTitle' => 'required|min:5|max:20',
            'expenseDescription' => 'required|min:10|max:225',
            'expenseAmount' => 'required|numeric',
            'expenseCategory' => 'required',
        ]);

        $expense->update([
            'expenseTitle' => $validated['expenseTitle'],
            'expenseDescription' => $validated['expenseDescription'],
            'expenseAmount' => $validated['expenseAmount'],
            'expenseCategory' => $validated['expenseCategory'],
        ]);

        return redirect()->route('expenses.show', $expense)->withErrors('message')->with('message')->with('message', 'Update expense Entry Successfully!');
    }

    public function destroy(expense $expense)
    {
        $expense->delete();

        return redirect()->route('expenses.index')->with('message', 'expense Entry Deleted!');
    }
}
