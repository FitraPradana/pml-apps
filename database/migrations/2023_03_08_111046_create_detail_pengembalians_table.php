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
        Schema::create('detail_pengembalians', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('kode_detail_pengembalian');
            $table->timestamps();

            $table->string('pengembalian_id');
            $table->foreign('pengembalian_id')->references('id')->on('pengembalians');

            $table->string('document_id');
            $table->foreign('document_id')->references('id')->on('documents');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('detail_pengembalians');
    }
};
