<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Helpers\Uuid;

class ProductsVouchersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {   
        DB::table('products_vouchers')->delete();
        
        $ids = [];
        
        do{
            $product_id = rand(1, 100);
            $voucher_id = rand(1, 1000);
            
            $ids[$product_id . "_" . $voucher_id] = Array(
                'product_id' =>  $product_id,
                'voucher_id' => $voucher_id,
            );
            
        }while(sizeof($ids) < 2000);
        
        foreach($ids as $id){            
            $dt = Carbon::now();
            $dateNow = $dt->toDateTimeString();
            
            $vouchers = [
                [
                    'uuid' => Uuid::get(),
                    'product_id' =>  $id['product_id'],
                    'voucher_id' => $id['voucher_id'],
                    'is_active' => true,
                    'created_at' => $dateNow,
                    'updated_at' => $dateNow,
                ]
            ];
            
            DB::table('products_vouchers')->insert($vouchers);
        }
    }
}
