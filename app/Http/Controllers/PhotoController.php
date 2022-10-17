<?php

namespace App\Http\Controllers;
use App\Models\Product;
use App\Models\Photo;
use Session;
use Redirect;
use Illuminate\Http\Request;

class PhotoController extends Controller
{
    public function create(){
        return view('upload');
    }

    public function store(Request $request,$id){
        $name = $request->file('image')->getClientOriginalName();
        $splited = explode('.',$name);
        $basename = $splited[0];
        $basename = uniqid($basename);
        $splited[0] = $basename;
        $name=implode(".",$splited);
        $size = $request->file('image')->getSize();
        if($size > 50000){
            Session::flash('message', "Velicina slike je prevelika!");
            return Redirect::back();
        }
        else{
        $request->file('image')->storeAs('public/images/', $name);
        $photo = new Photo();
        $photo->name = $name;
        $photo->size = $size;
        $photo->product_id = $id;
        $photo->save();
        return redirect()->back();
        }
    }

    public function destroy($id)
    {
        echo Photo::find($id);
    	Photo::find($id)->delete();
    	return back()
    		->with('success','Image removed successfully.');	
    }
}
