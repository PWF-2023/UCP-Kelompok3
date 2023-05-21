<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function Index()
    {
        return view('category.index');
    }
    public function Create()
    {
        return view('category.create');
    }
    public function Edit()
    {
        return view('category.edit');
    }
}
