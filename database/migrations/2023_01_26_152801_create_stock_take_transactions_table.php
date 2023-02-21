<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stock_take_transactions', function (Blueprint $table) {
            $table->id();
            $table->dateTime('tgl_stock_take');
            $table->string('status_asset');
            $table->text('remarks_stock_take');
            $table->string('last_img_condition_stock_take');
            $table->string('last_update_name');

            $table->foreignId('fixed_asset_id')->constrained();

            // $table->string('site_id')->nullable();
            // $table->foreign('site_id')->references('id')->on('sites');

            $table->foreignId('location_id')->nullable()->constrained();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('stock_take_transactions');
    }
};
