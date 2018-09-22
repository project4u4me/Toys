<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public function vouchers()
    {
        return $this->hasMany('App\Model\ProductVoucher');
    }
}
