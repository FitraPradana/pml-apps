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
            $table->uuid('id')->primary();
            $table->date('tgl_posting')->nullable();
            $table->string('status_doc');
            $table->string('voucher');
            $table->string('invoice')->nullable();
            $table->string('last_settle_voucher')->nullable();
            $table->date('last_settle_date')->nullable();
            $table->string('description')->nullable();
            $table->decimal('nominal', 15, 3);
            $table->string('jenis_doc')->nullable();
            $table->string('pic')->nullable();
            $table->date('tgl_terima_doc')->nullable();
            $table->string('lemari')->nullable();
            $table->string('lorong')->nullable();
            $table->string('baris')->nullable();
            $table->string('box')->nullable();
            $table->string('no_folder')->nullable();
            $table->string('upload_doc')->nullable();
            $table->string('kelengkapan_doc')->nullable();
            $table->text('ket_doc')->nullable();
            $table->timestamps();

            // $table->foreignId('location_id')->nullable()->constrained();

            $table->string('vendor_id')->nullable();
            $table->foreign('vendor_id')->references('id')->on('vendors');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Schema::dropIfExists('documents');
    }
};
