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
            $table->id();
            $table->string('name');
            $table->string('user_login');
            $table->string('id_card')->nullable();
            $table->string('email')->nullable();
            $table->string('role')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('company')->nullable();
            $table->string('department')->nullable();
            $table->string('phone')->nullable();
            $table->string('password');
            $table->string('temp_password')->nullable();
            $table->timestamp('temp_password_expires_at')->nullable(); // Expiration timestamp
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
