<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Artisan::call('migrate:rollback');
        Artisan::call('migrate');
        
        $this->call(ProductsTableSeeder::class);
        $this->call(DiscountsTableSeeder::class);
        $this->call(VouchersTableSeeder::class);
        $this->call(ProductsVouchersTableSeeder::class);
    }
}
