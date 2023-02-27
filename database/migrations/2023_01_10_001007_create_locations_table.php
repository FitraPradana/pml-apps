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
        Schema::create('locations', function (Blueprint $table) {
            $table->id();
            $table->string('location_code');
            $table->string('location_name');
            $table->text('location_remarks')->nullable();

            // $table->string('site_id')->nullable();
            // $table->foreign('site_id')->references('id')->on('sites');
            $table->foreignId('site_id')->constrained();

            $table->foreignId('room_id')->constrained();

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
        Schema::dropIfExists('locations');
    }
};
