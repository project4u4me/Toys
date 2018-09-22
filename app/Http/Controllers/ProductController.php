<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Show All Products view
     * 
     * @return view
     */
    public function showProducts()
    {
        return view('products');
    }
    
    /**
     * Show certain Product
     * 
     * @param string $uuid
     * @return view
     */
    public function showProduct($uuid)
    {
        return view('product')->with('uuid',$uuid);
    }
}
