<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Helpers\Uuid;

class DiscountsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('discounts')->delete();
                
        $dt = Carbon::now();
        $dateNow = $dt->toDateTimeString();

        $discounts = [
            [
                'uuid' => Uuid::get(),
                'value' => 10,
                'name' => '10%',
                'is_active' => true,
                'created_at' => $dateNow,
                'updated_at' => $dateNow,
            ],
            [
                'uuid' => Uuid::get(),
                'value' => 15,
                'name' => '15%',
                'is_active' => true,
                'created_at' => $dateNow,
                'updated_at' => $dateNow,
            ],
            [
                'uuid' => Uuid::get(),
                'value' => 20,
                'name' => '20%',
                'is_active' => true,
                'created_at' => $dateNow,
                'updated_at' => $dateNow,
            ],
            [
                'uuid' => Uuid::get(),
                'value' => 25,
                'name' => '25%',
                'is_active' => true,
                'created_at' => $dateNow,
                'updated_at' => $dateNow,
            ],
        ];
        
        DB::table('discounts')->insert($discounts);
    }
}
