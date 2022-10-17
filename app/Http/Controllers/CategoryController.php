<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Subcategory;

class CategoryController extends Controller
{
    public function index()
    {
    }

    public function store(Request $request)
    {
        $request->validate([
            'category' => 'required',
        ]);
        
        $categoryEntry = new Category();
        $categoryEntry->name = $request->input('category');
        $categoryEntry->save();

        $subcategoryEntry = new Subcategory();
        $select=Category::where('name',$categoryEntry->name)->first();
        $category_id = $select->id;

        $subcategories = $request->get('subcategory');

        $max = count($subcategories) - 1;

        for ($i = 0; $i< $max; $i++){
            $subcategoryEntry = new Subcategory();
            $subcategoryEntry->name = $subcategories[$i];
            $subcategoryEntry->category_id = $category_id;
            $subcategoryEntry->save();
        }

       return back()->with('success', 'Your data has been successfully inserted'); 
    }
}

