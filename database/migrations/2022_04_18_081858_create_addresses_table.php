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
        Schema::create(table: 'addresses', callback:  function (Blueprint $table) {
            $table->id();
            $table->string(column: 'street', length: 191);
            $table->string(column: 'suburb', length: 50);
            $table->string(column: 'state', length: 30)->comment('');
            $table->string(column: 'post_code', length: 10);
            $table->string(column: 'country', length: 50)->default('Australia');
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
        Schema::dropIfExists(table: 'addresses');
    }
};
