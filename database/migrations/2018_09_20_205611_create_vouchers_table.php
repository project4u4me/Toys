<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVouchersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vouchers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->char('uuid',32)->unique();
            $table->bigInteger('discount_id')->unsigned()->index();
            $table->char('code',16);
            $table->date('start');
            $table->date('end');
            $table->boolean('is_active')->default(true);
            $table->timestamps();
            
            $table->index('start');
            $table->index('end');
            
            $table->foreign('discount_id')
                    ->references('id')
                    ->on('discounts')
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
        Schema::dropIfExists('vouchers');
    }
}
