<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        return view('category.index');
    }

    public function create()
    {
        return view('category.create');
    }

    public function detroy(Category $category)
    {
        if(auth()->user()->id == $category->user_id){
            $category->delete();
            return redirect()->route('category.index')->with('success', 'Category deleted successfully');
        }else{
            return redirect()->route('category.index')->with('danger', 'You are not authorized to delete this category');
        }
        //return view('category.delete');
    }
}
