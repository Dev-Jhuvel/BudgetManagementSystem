<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::orderBy('categoryName', 'ASC')->where('user_id',  Auth::user()->id);

        if (request()->has('search')) {
            $categories = $categories->orderBy('categoryName', 'ASC')->where('categoryName', 'like', '%' . request('search', '') . '%');
        }

        if (request()->has('type')) {
            $categories = $categories->orderBy('categoryName', 'ASC')->where('categoryType', 'like', '%' . request('type', '') . '%');
        }

        return view('categories.index', ['categories' => $categories->paginate(5)]);
    }

    public function store()
    {
        $user_id = Auth::user()->id;
        $validated = request()->validate([
            'categoryName' => 'required|min:3|max:15,'
                . Rule::unique('categories', 'categoryName',)
                ->ignore('$user_id', 'user_id'),
            'categoryType' => 'required',
        ]);

        $validated['user_id'] = $user_id;

        Category::create([
            'categoryName' => $validated['categoryName'],
            'categoryType' => $validated['categoryType'],
            'user_id' => $validated['user_id'],
        ]);

        return redirect()->route('categories.index')->withErrors('message')->with('message', 'New Category Added!');
    }

    public function destroy(Category $category)
    {
        $category->delete();

        return redirect()->route('categories.index')->with('message', 'Category Deleted Successfully');
    }
}
