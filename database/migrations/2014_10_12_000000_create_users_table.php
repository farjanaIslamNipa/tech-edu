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
            $table->string(column: 'first_name', length: 30);
            $table->string(column: 'last_name', length: 30)->nullable();
            $table->string(column: 'email', length: 50)->unique();
            $table->string(column: 'phone_number', length: 20);
            $table->string(column: 'password')->nullable();
            $table->timestamp(column: 'email_verified_at')->nullable();
            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();
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
