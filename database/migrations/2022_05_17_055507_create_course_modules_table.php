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
        Schema::create(table: 'course_modules', callback: function (Blueprint $table) {
            $table->id();
            $table->string(column: 'name', length: 100);
            $table->string(column: 'code', length: 50)->nullable();
            $table->float(column: 'rating', total: 2, places: 1)->default(0);
            $table->string(column: 'slug', length: 120)->nullable();
            $table->text(column: 'payment_link')->nullable();
            $table->integer(column: 'price')->default( 0)->comment('Price in cents');
            $table->boolean(column: 'status')->default(1)->comment('0:Inactive, 1:Active');
            $table->tinyInteger(column: 'training_type', unsigned: true)->default(1)->comment('0:Onsite Training, 1:Remote Learning');
            $table->tinyText(column: 'short_description')->nullable();
            $table->longText(column: 'description')->nullable();
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
        Schema::dropIfExists(table: 'course_modules');
    }
};
