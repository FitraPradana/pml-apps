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
            $table->uuid('id')->primary();
            $table->string('fixed_assets_number')->unique();
            $table->string('fixed_assets_name');
            $table->string('fixed_assets_group');
            $table->string('main_fixed_assets')->nullable();
            $table->string('information3')->nullable();
            $table->string('vessel_id')->nullable();
            $table->dateTime('acquisition_date')->nullable();
            $table->decimal('net_book_value', 15, 3)->nullable();
            $table->dateTime('net_book_value_date')->nullable();
            $table->dateTime('last_update_stock_take_date')->nullable();
            $table->string('pic')->nullable();
            $table->text('remarks_fixed_assets')->nullable();
            $table->string('qr_code')->unique();
            $table->string('img_asset')->nullable();
            $table->string('last_modified_name')->nullable();
            $table->string('last_img_condition_stock_take')->nullable();
            $table->enum('status_asset', ['GENERAL', 'GOOD', 'NEED_REPLACEMENT', 'NEED_REPAIR', 'DONT_EXIST'])->default('GENERAL');
            $table->enum('is_used', ['GENERAL', 'DIPAKAI', 'TIDAK_DIPAKAI'])->default('GENERAL');


            $table->string('location_id')->nullable();
            $table->foreign('location_id')->references('id')->on('locations');

            $table->string('asset_category_id')->nullable();
            $table->foreign('asset_category_id')->references('id')->on('asset_categories');


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
