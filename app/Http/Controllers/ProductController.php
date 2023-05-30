<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{

    public function show(Product $product){

        $this->authorize('status', $product);

        return view('products.show', compact('product'));
    }
}
