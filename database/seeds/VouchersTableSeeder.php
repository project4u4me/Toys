<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Helpers\Uuid;

class VouchersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        DB::table('vouchers')->delete();
        
        for($i=0;$i<1000;$i++){            
            $dt = Carbon::now();
            $dateNow = $dt->toDateTimeString();
            
            $dt_s = $dt->subDays(rand(1, 7));
            $dateStart = $dt_s->toDateString();
            
            $dt_e = $dt_s->addDays(rand(1, 14));
            $dateEnd = $dt_e->toDateString();
            
            $vouchers = [
                [
                    'uuid' => Uuid::get(),
                    'discount_id' => rand(1, 4),
                    'code' => strtoupper(str_random(3) . "-" . rand(100, 999) . "-" . str_random(3) . "-" . rand(100, 999)),
                    'start' => $dateStart,
                    'end' => $dateEnd,
                    'is_active' => true,
                    'created_at' => $dateNow,
                    'updated_at' => $dateNow,
                ]
            ];
            
            DB::table('vouchers')->insert($vouchers);
        }
    }
}
