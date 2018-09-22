<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Helpers\Uuid;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('products')->delete();
        
        for($i=0;$i<100;$i++){            
            $dt = Carbon::now();
            $dateNow = $dt->toDateTimeString();
            
            $products = [
                [
                    'uuid' => Uuid::get(),
                    'name' => 'Product name ' . $i,
                    'price' => rand(12, 157) / 10,
                    'stock' => rand(0, 999),
                    'is_active' => true,
                    'created_at' => $dateNow,
                    'updated_at' => $dateNow,
                ]
            ];
            
            DB::table('products')->insert($products);
        }
    }
}
