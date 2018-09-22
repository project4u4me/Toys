<?php

namespace App\Api;

use Illuminate\Http\Request;
use Response;
use Session;
use Cache;
use Input;

class CartController extends Controller
{
    /**
     * Count Items
     * 
     * Count items in Cache
     * 
     * @param string $token
     * @return json string
     */
    public function countCartItems($token)
    {
        $response = ['success' => false, 'data' => [], 'errors' => []];
        $responseCode = 500;
        
        $cart = [];
        if(Cache::has($token))
            if(is_array(Cache::get($token)))
                $cart = Cache::get($token);
        
        $counter = sizeof($cart);
        
        $responseCode = 200;
        $response['success'] = true;
        $response['data'] = array('items'=>$counter,'cart'=>Cache::get($token));
        
        return Response::json($response,$responseCode);
    }
    
    /**
     * Update Cart
     * 
     * Update values or add new items 
     * in case of add it to cart or change value
     * 
     * @param string $token
     * @return json string
     */
    public function updateCart($token)
    {
        $response = ['success' => false, 'data' => [], 'errors' => []];
        $responseCode = 500;
        
        $input = Input::all();
        $uuid = $input['uuid'];
        $best_price = $input['best_price'];
        $items = $input['items'];
        
        $cart = [];
        $item = [];
        if(is_array(Cache::get($token)))
            $cart = Cache::get($token);
        
        Cache::forget($token);
        
        if(isset($cart[$uuid])){
            $item = $cart[$uuid];
            
            $item['value'] += floatval($best_price) * intval($items);
            $item['quantity'] += intval($items);
            $cart[$uuid] = $item;
            
            Cache::add($token,$cart,120);
        } else { 
            $item = [];
            
            $item['uuid'] = $uuid;
            $item['value'] = floatval($best_price) * intval($items);
            $item['quantity'] = intval($items);            
            $cart[$uuid] = $item;
            
            Cache::add($token,$cart,120);
        }
        
        $responseCode = 200;
        $response['success'] = true;
        $response['data'] = array('item' => $item, 'token' => $token);
        
        return Response::json($response,$responseCode);
    }
    
    /**
     * Remove item
     * 
     * Remove certain item from Cache.
     * 
     * @param string $token
     * @return json string
     */
    public function deleteCartItem($token)
    {
        $response = ['success' => false, 'data' => [], 'errors' => []];
        $responseCode = 500;
        
        $input = Input::all();
        $uuid = $input['uuid'];
        
        $cart = [];
        if(is_array(Cache::get($token)))
            $cart = Cache::get($token);
        
        Cache::forget($token);
        
        if(isset($cart[$uuid]))
            unset($cart[$uuid]);
        
        Cache::add($token,$cart,120);
        
        $responseCode = 200;
        $response['success'] = true;
        $response['data'] = array('token' => $token);
        
        return Response::json($response,$responseCode);
    }
    
    /**
     * Buy Cart
     * 
     * Remove items from cache.
     * 
     * @param string $token
     * @return json string
     */
    public function buyCart($token)
    {
        $response = ['success' => false, 'data' => [], 'errors' => []];
        $responseCode = 500;
        
        Cache::forget($token);
        
        $responseCode = 200;
        $response['success'] = true;
        $response['data'] = array('token' => $token);
        
        return Response::json($response,$responseCode);
    }
}
