<?php

namespace App\Http\Controllers;
use App\Category;

use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function getAll(){
        $cats = Category::select('name')->orderBy('name')->get();
        return $cats;
    }
}
