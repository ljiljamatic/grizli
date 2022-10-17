<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class SearchController extends Controller
{
    public function search(Request $request){
        // Get the search value from the request
        $search = $request->input('search');

        // Search in the title and body columns from the posts table
        $posts = Product::query()
            ->where('name', 'LIKE', "%{$search}%")
            ->where('status', 1)
            ->get();

        return view('search', compact('posts'));
    }
}
