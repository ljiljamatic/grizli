<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Form;
use App\Models\Product;
use App\Models\Category;
use App\Models\Subcategory;
use Faker\Factory as Faker;
use Eastwest\Json\Facades\Json;
use Session;
use Redirect;

class FormController extends Controller
{

    public function create()
    {
        return view('create');
    }

    public function destroy($id)
    {
        $select = Form::find($id);
        $path = public_path('/images/'.$select->product_id.'/'.$select->filename);
        unlink($path);
        Form::find($id)->delete();
    	return back()
    		->with('success','Image removed successfully.');
    }


    public function archive()
    {
        $name = $_GET['name'];
        $category = Category::where('name', $name)->first();
        $id = $category->id;
        $subcategories = Subcategory::where('category_id', $id)->get()->pluck('name');
        return response()->json(['subcats' => $subcategories]);
    }

    public function store(Request $request)
    {

       $this->validate($request, [
                'name' => 'required',
                'category' => 'required',
                'description' => 'required',
                'filename' => 'required',
                'filename.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'

        ]);
        $order = 0;
        if($request->hasfile('filename'))
         {
            $faker = Faker::create();
            $productEntry = new Product();
            $productEntry->name = $request->input('name');
            $productEntry->category = $request->input('category');
            $productEntry->description = $request->input('description');
            $productEntry->linkToProduct = $faker->unique()->firstname();
            $productEntry->status = 1;
            $productEntry->save();
    
            $select=Product::where('name',$productEntry->name)->first();
            $prod_id = $select->id;

            foreach($request->file('filename') as $image)
            {
                $name=$image->getClientOriginalName();
                $splited = explode('.',$name);
                $basename = $splited[0];
                $basename = uniqid($basename);
                $splited[0] = $basename;
                $name=implode(".",$splited);
                $image->move(public_path().'/images/'.$prod_id, $name);  
                $form= new Form();
                $form->filename = $name;
                $form->product_id = $prod_id;
                $form->order = $order;
                $order = $order + 1;
                $form->save();
            }
         }


        return back()->with('success', 'Your images has been successfully added'); 
    }
}
