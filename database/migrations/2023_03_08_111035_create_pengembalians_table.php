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
        Schema::create('pengembalians', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('kode_pengembalian')->unique();
            $table->date('tgl_pengembalian');
            $table->date('due_tgl_pengembalian');
            $table->text('ket_pengembalian')->nullable();
            $table->timestamps();

            $table->string('pinjaman_id');
            $table->foreign('pinjaman_id')->references('id')->on('pinjaman');

            $table->string('user_id');
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pengembalians');
    }
};
