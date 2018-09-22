<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsVouchersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products_vouchers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->char('uuid',32)->unique();
            $table->bigInteger('product_id')->unsigned()->index();
            $table->bigInteger('voucher_id')->unsigned()->index();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
            
            $table->unique(['product_id', 'voucher_id']);
            
            $table->foreign('product_id')
                    ->references('id')
                    ->on('products')
                    ->onDelete('cascade');
            
            $table->foreign('voucher_id')
                    ->references('id')
                    ->on('vouchers')
                    ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products_vouchers');
    }
}
