<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
class HomeController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

    public function order()
    {
        $first = $_GET['first'];
        $second = $_GET['second'];
        $firstSelect = Product::where('filename', $first)->first();
        $secondSelect = Product::where('filename', $second)->first();
        $firstOrder = $firstSelect->order;
        $firstSelect->update(['position'=>$secondSelect->position]);
        $secondSelect->update(['position'=>$firstOrder]);
        return response()->json(['subcats' => $first]);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }
    
    public function show(Request $request,$word) {
        $select=Product::where('linkToProduct',$word)->first();
        $allProducts = Product::all();
        $count = $allProducts->count();
        
        $last = Product::orderBy('id', 'DESC')->first();
        $first = Product::where('id', '>', 0)->where('status', 1)->first();

        $nextProduct = Product::where('id', '>', $select->id)->where('status', 1)->first();
        $prevProduct = Product::orderBy('id', 'DESC')->where('id', '<', $select->id)->where('status', 1)->first();

        if($select==null)
           return abort(404);
        return view('view',['data'=>$select, 'next'=>$nextProduct, 'previous'=>$prevProduct]);
    }

    public function delete(Request $request, $id)
    {
        Product::where('id',$id)->update(['status'=>-1]);
        return redirect()->back()->with('status','Updated Successfully');
    }

}
