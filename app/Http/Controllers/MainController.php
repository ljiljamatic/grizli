<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use Auth;
use App\Models\Form;

class MainController extends Controller
{
    public function index()
    {
        $first = $_GET['first'];
        $second = $_GET['second'];
        $firstSelect = Form::where('filename', $first)->first();
        $secondSelect = Form::where('filename', $second)->first();
        $firstOrder = $firstSelect->order;
        $secondOrder = $secondSelect->order;
        $firstSelect->update(['order'=>$secondOrder]);
        $secondSelect->update(['order'=>$firstOrder]);
        dd($secondOrder);
    }

    function home(){
        return view('sign');
    }

    function checklogin(Request $request){
        $this->validate($request,[
            'email' => 'required|email',
            'password' => 'required|alphaNum|min:3',
        ]);

        $user_data = array(
            'email' => $request->get('email'),
            'password' => $request->get('password')
        );

        if(Auth::attempt($user_data)){
            return redirect('/home');
        }
        else {
            return back()->with('error', 'Wrong Login Details');
        }
    }

    function successlogin(){
        return view('successlogin');
    }

    function logout(){
        Auth::logout();
        return view('sign');
    }

    
}
