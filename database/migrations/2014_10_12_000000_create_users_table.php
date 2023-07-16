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
        Schema::create('users', function (Blueprint $table) {
            // $table->id();
            $table->uuid('id')->primary();
            $table->string('personnel_number');
            $table->string('username');
            $table->string('full_name');
            $table->string('email')->unique();
            $table->string('password');
            // $table->timestamp('email_verified_at')->nullable();
            // $table->enum('gender', ['general', 'male', 'female'])->default('general');
            $table->enum('type', ['general', 'employee', 'vessel'])->default('general');
            $table->enum('roles', ['admin', 'user', 'vessel'])->default('user');
            $table->string('image')->nullable();
            $table->string('remarks_user')->nullable();
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
};
