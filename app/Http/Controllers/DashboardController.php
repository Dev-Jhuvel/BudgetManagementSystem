<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Expense;
use App\Models\Income;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $incomeSum = Income::select('incomeAmount')->where(
            'user_id',
            Auth::user()->id,
        )->sum('incomeAmount');


        $expenseSum = Expense::where(
            'user_id',
            Auth::user()->id,
        )->sum('expenseAmount');


        $expenseByCategories  = DB::table('expenses')
            ->select('expenseCategory', DB::raw('sum(expenseAmount) as SUM'))
            ->groupBy('expenseCategory')
            ->get();

        $incomeByCategories = DB::table('incomes')
            ->select('incomeCategory', DB::raw('sum(incomeAmount) as SUM'))
            ->groupBy('incomeCategory')
            ->get();

        $expenseArray = DB::table('expenses')
            ->select('expenseCategory as category', DB::raw('sum(expenseAmount) as SUM'))->groupBy('expenseCategory')
            ->pluck('SUM', 'category')
            ->toArray();
        $balance = $incomeSum - $expenseSum;
        return view("dashboard.dashboard", data: ['incomeSum' => $incomeSum, 'expenseSum' => $expenseSum, 'balance' => $balance, 'expenseByCategories' => $expenseByCategories, 'incomeByCategories' => $incomeByCategories, 'expenseArray' => $expenseArray]);
    }

    public function overview()
    {
        $expenseByCategories  = DB::table('expenses')
            ->select('expenseCategory', DB::raw('sum(expenseAmount) as SUM'))
            ->groupBy('expenseCategory')
            ->get();

        $incomeByCategories = DB::table('incomes')
            ->select('incomeCategory', DB::raw('sum(incomeAmount) as SUM'))
            ->groupBy('incomeCategory')
            ->get();
        return view('dashboard.overview', ['expenseByCategories' => $expenseByCategories, 'incomeByCategories' => $incomeByCategories]);
    }

    // Book::where(function ($query) use($keyword) {
    //     $query->where('judul', 'like', '%' . $keyword . '%')
    //        ->orWhere('writters', 'like', '%' . $keyword . '%');
    //   })
    // ->get()
}
