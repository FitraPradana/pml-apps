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
        Schema::create('mapping_asset_categories', function (Blueprint $table) {
            $table->uuid('id')->primary();

            $table->string('asset_category_id');
            $table->foreign('asset_category_id')->references('id')->on('asset_categories');

            $table->string('location_id');
            $table->foreign('location_id')->references('id')->on('locations');

            $table->text('remarks_mapping_asset_category')->nullable();

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
        Schema::dropIfExists('mapping_asset_categories');
    }
};
