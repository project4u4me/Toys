<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class ProductVoucher extends Model
{
    protected $table = 'products_vouchers';
    
    public function voucher()
    {
        return $this->belongsTo('App\Model\Voucher','voucher_id', 'id');
    }
    public function product()
    {
        return $this->belongsTo('App\Model\Product','product_id', 'id');
    }
}
