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
        Schema::create('pinjaman', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('kode_pinjaman')->unique();
            $table->date('tgl_pinjaman');
            $table->date('tgl_pengembalian');
            $table->text('ket_pinjaman')->nullable();
            $table->enum('status_pinjam', ['DIPINJAM', 'DIPERPANJANG', 'DIKEMBALIKAN']);
            $table->string('kode_ref_perpanjangan')->nullable();
            $table->timestamps();

            $table->string('user_id');
            $table->foreign('user_id')->references('id')->on('users');

            $table->string('pengajuan_pinjaman_id');
            $table->foreign('pengajuan_pinjaman_id')->references('id')->on('pengajuan_pinjaman');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pinjamen');
    }
};
