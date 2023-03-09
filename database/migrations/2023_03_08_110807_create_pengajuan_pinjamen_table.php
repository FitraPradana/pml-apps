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
        Schema::create('pengajuan_pinjaman', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('kode_pengajuan_pinjaman')->unique();
            $table->date('tgl_pengajuan_pinjaman');
            // $table->date('plan_tgl_pinjaman');
            // $table->date('plan_tgl_pengembalian');
            $table->text('ket_pengajuan_pinjaman')->nullable();
            $table->enum('approval_status', ['open', 'approved', 'completed'])->default('open');
            $table->string('approval_name')->nullable();
            $table->timestamps();

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
        Schema::dropIfExists('pengajuan_pinjaman');
    }
};
