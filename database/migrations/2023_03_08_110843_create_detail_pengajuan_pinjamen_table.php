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
        Schema::create('detail_pengajuan_pinjaman', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('kode_detail_pengajuan_pinjaman')->unique();
            $table->timestamps();

            $table->string('pengajuan_pinjaman_id');
            $table->foreign('pengajuan_pinjaman_id')->references('id')->on('pengajuan_pinjaman');

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
        Schema::dropIfExists('detail_pengajuan_pinjaman');
    }
};
