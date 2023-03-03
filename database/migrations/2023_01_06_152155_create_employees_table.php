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
        Schema::create('employees', function (Blueprint $table) {
            $table->uuid('id')->primary();
            // $table->string('emp_id', 50)->primary();
            $table->string('emp_name');
            $table->string('emp_email');
            $table->string('emp_phone');
            $table->string('emp_remarks');

            // $table->foreignId('department_id')->nullable()->constrained();

            $table->string('department_id')->nullable();
            $table->foreign('department_id')->references('id')->on('departments');

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
        Schema::dropIfExists('employees');
    }
};
