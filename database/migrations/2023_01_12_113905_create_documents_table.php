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
        Schema::create('documents', function (Blueprint $table) {
            $table->id();
            $table->dateTime('tgl_posting');
            $table->string('voucher');
            $table->string('last_settle_voucher');
            $table->dateTime('last_settle_date');
            $table->string('description');
            $table->bigInteger('nominal');
            $table->string('kode_vendor');
            $table->string('nama_vendor');
            $table->string('jenis_doc')->nullable();
            $table->string('pic')->nullable();
            $table->dateTime('tgl_terima_doc')->nullable();
            $table->string('lemari')->nullable();
            $table->string('lorong')->nullable();
            $table->string('baris')->nullable();
            $table->string('box')->nullable();
            $table->string('no_folder')->nullable();
            $table->string('upload_doc')->nullable();
            $table->string('kelengkapan_doc')->nullable();
            $table->text('ket_doc')->nullable();
            $table->timestamps();

            $table->foreignId('location_id')->nullable()->constrained();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('documents');
    }
};
