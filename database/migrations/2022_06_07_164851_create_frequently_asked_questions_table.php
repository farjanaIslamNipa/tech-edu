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
        Schema::create(table: 'frequently_asked_questions', callback: function (Blueprint $table) {
            $table->id();
            $table->string(column: 'question', length: 191);
            $table->string(column: 'answer', length: 191);
            $table->tinyInteger(column: 'order', unsigned: true);
            $table->boolean(column: 'status')->default(true);
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
        Schema::dropIfExists(table: 'frequently_asked_questions');
    }
};
