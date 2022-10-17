<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Form;
use App\Models\Product;
use App\Models\Category;
use App\Models\Subcategory;

class UpdateController extends Controller
{
    public function update($id)
    {
        $select = Product::find($id);
        $category_name = $select->category;
        $category_id = Category::query()->where('name', 'LIKE', $category_name)->first()->id;
        $subcategories = Subcategory::query()->where('category_id', 'LIKE', $category_id)->get();
        return view('update_product', compact('select', 'subcategories'));
    }

    public function change(Request $request, $id)
    {
        $select = Product::find($id);
        $name = $request->input('name');
        $category = $request->input('category');
        $category_id = Category::query()->where('name', 'LIKE', $category)->first()->id;
        $description = $request->input('description');
        $subcategories = $request->get('subcategory');
        $max = count($subcategories) - 1;

        for ($i = 0; $i< $max; $i++){
            if(Subcategory::query()->where('category_id', 'LIKE', $category_id)->first() != null){
                (Subcategory::query()->where('category_id', 'LIKE', $category_id)->first())->delete();
            }
        }

        for ($i = 0; $i< $max; $i++){
            if($subcategories[$i] != '') {
            $subcategoryEntry = new Subcategory();
            $subcategoryEntry->name = $subcategories[$i];
            $subcategoryEntry->category_id = $category_id;
            $subcategoryEntry->save();
            }
        }

        $select->update(['name'=>$name, 'category'=>$category,'description'=>$description]);
        return back()->with('success', 'Your product has been successfully updated'); 
    }
}
