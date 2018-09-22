<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Product;
use Cache;
use Session;

class CartController extends Controller
{
    /**
     * Show Cart view
     * 
     * @return view
     */
    public function showCart()
    {
        $token = Session::getId();
        
        $carts = [];
        if(Cache::has($token))
            if(is_array(Cache::get($token)))
                $carts = Cache::get($token);
            
        foreach($carts as $k=>$v){
            $product = Product::where('uuid',$k)
                    ->first(array('name'));
            $carts[$k]['name'] = $product->name;
        }
        
        return view('cart')->with('cart',$carts);
    }
}
