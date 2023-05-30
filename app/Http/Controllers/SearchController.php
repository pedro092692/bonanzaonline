<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Subcategory;
use Livewire\WithPagination;

class SearchController extends Controller
{
    public function __invoke(Request $request)
    {

        $name = $request->name;
        
        $products = Product::where('name', 'LIKE' , "%" . $name  . "%")
        ->where('status', 1)
        ->paginate(8);

        $subcategories = Subcategory::where('name', 'LIKE' , "%" . $name  . "%")
        ->take(8)->get();

        if($name == null){
            $products = null;
        }

        return view('search', compact('products', 'subcategories'));
    }
}
