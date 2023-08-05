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
        Schema::create('log_trans_fixed_assets', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->dateTime('log_transdate');
            $table->text('remarks_log');
            $table->string('last_img_condition_stock_take')->nullable();
            $table->string('last_update_name');
            $table->string('ip_user_update')->nullable();
            $table->string('type_update');
            $table->enum('status_asset', ['GENERAL', 'GOOD', 'NEED_REPLACEMENT', 'NEED_REPAIR', 'DONT_EXIST'])->default('GENERAL');
            $table->enum('is_used', ['GENERAL', 'DIPAKAI', 'TIDAK_DIPAKAI'])->default('GENERAL');



            $table->string('fixed_asset_id');
            $table->foreign('fixed_asset_id')->references('id')->on('fixed_assets');

            $table->string('location_id')->nullable();
            $table->foreign('location_id')->references('id')->on('locations');

            $table->string('user_id');
            $table->foreign('user_id')->references('id')->on('users');


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
        Schema::dropIfExists('log_trans_fixed_assets');
    }
};
