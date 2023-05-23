<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::where('user_id', auth()->user()->id)
            ->orderBy('created_at', 'desc')
            ->get();


        return view('category.index', compact('categories'));
    }

    public function store(Request $request, Category $category)
    {
        $request->validate([
            'title' => 'required|max:255',
        ]);
        $request->user()->categories()->create($request->all());
        return redirect()->route('category.index')->with('success', 'Category create successfully');
    }

    public function create()
    {
        return view('category.create');
    }

    public function edit(Category $category)
    {
        if (auth()->user()->id == $category->user_id) {
            return view('category.edit', compact('category'));
        }

        return redirect()->route('category.index')->with('danger', 'You are not authorized to edit this category!');
    }

    public function update(Request $request, Category $category)
    {
        $request->validate([
            'title' => 'required|max:255',
        ]);

        // Practical
        // $todo->title = $request->title;
        // $todo->save();

        // Eloquent way - Readable
        $category->update([
            'title' => ucfirst($request->title),
        ]);

        return redirect()->route('category.index')->with('success', 'Category updated successfully');
    }

    public function destroy(Category $category)
    {
        if (auth()->user()->id == $category->user_id) {
            $category->delete();
            return redirect()->route('category.index')->with('success', 'Category deleted successfully');
        } else {
            return redirect()->route('category.index')->with('danger', 'You are not authorized to delete this category');
        }
        //return view('category.delete');
    }
}
