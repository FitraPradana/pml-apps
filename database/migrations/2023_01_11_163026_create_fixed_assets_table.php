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
        Schema::create('fixed_assets', function (Blueprint $table) {
            $table->id();
            $table->string('fixed_assets_number');
            $table->string('fixed_assets_name');
            $table->string('fixed_assets_group');
            $table->string('main_fixed_assets')->nullable();
            $table->string('information3')->nullable();
            $table->string('vessel_id')->nullable();
            $table->dateTime('acquisition_date')->nullable();
            $table->decimal('net_book_value', 15, 3)->nullable();
            $table->string('status_asset')->nullable();
            $table->dateTime('last_update_stock_take_date')->nullable();
            $table->string('pic')->nullable();
            $table->text('remarks_fixed_assets')->nullable();
            $table->string('qr_code')->unique();
            $table->string('img_asset')->nullable();
            $table->string('last_modified_name')->nullable();
            $table->string('last_img_condition_stock_take')->nullable();

            // $table->string('site_id')->nullable();
            // $table->foreign('site_id')->references('id')->on('sites');

            $table->foreignId('location_id')->nullable()->constrained();
            // $table->foreignId('site_id')->nullable()->constrained();

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
        Schema::dropIfExists('fixed_assets');
    }
};
