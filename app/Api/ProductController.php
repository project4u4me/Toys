<?php

namespace App\Api;

use Illuminate\Http\Request;
use App\Model\Product;
use App\Model\ProductVoucher;
use App\Model\Voucher;
use App\Model\Discount;
use Carbon\Carbon;
use Response;

class ProductController extends Controller
{
    /**
     * Get all products
     * 
     * @return json string
     */
    public function getProducts()
    {
        $response = ['success' => false, 'data' => [], 'errors' => []];
        $responseCode = 500;
        
        $products = Product::where('is_active',true)->get(array('uuid', 'name', 'price', 'stock'));
        
        $responseCode = 200;
        $response['success'] = true;
        $response['data'] = $products;
        
        return Response::json($response,$responseCode);
    }
    
    /**
     * Get certain product with vouchers
     * and discounts
     * 
     * @param type $uuid
     * @return type
     */
    public function getProduct($uuid)
    {
        $response = ['success' => false, 'data' => [], 'errors' => []];
        $responseCode = 500;        
        
        if(!empty($uuid)){            
            $product = Product::where([['uuid',$uuid],['is_active',true]])
                    ->first(array('id','uuid', 'name', 'price', 'stock'));
            
            if($product){                
                    $voucher_ids = ProductVoucher::where('product_id', $product->id)->get();
                    $de = Carbon::now()->subDays(1);
                    
                    $vouchers = [];
                    $discounts = 0;
                    foreach($voucher_ids as $voucher_id){
                        $voucher = Voucher::where([['id', $voucher_id->voucher_id],['end', '>', $de],['is_active',true]])
                                ->first(array('id','uuid', 'discount_id', 'code', 'start', 'end'));
                        if($voucher){
                            $discount = Discount::where('id',$voucher->discount_id)
                                    ->first(array('uuid', 'value', 'name'));
                            $discounts += intval($discount['value']);
                            unset($voucher['id']);
                            unset($voucher['discount_id']);

                            $voucher['discount'] = $discount;
                            $vouchers[] = $voucher;
                        }
                    }
                    unset($product['id']);
                    $product['max_discount'] = $discounts>60?60:$discounts;
                    $product['min_price'] = ($product['max_discount'] / 100) * $product->price;
                    $product['vouchers'] = $vouchers;
                
                $responseCode = 200;
                $response['success'] = true;
                $response['data'] = $product;
            } else {
                $responseCode = 404;
                $response['errors']['product'] = 'not-found';
            }
        } else {
            $responseCode = 406;
            $response['errors']['uuid'] = 'incorrect';
        }
        
        return Response::json($response,$responseCode);
    }
}
