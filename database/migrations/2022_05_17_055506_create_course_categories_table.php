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
        Schema::create(table: 'course_categories', callback: function (Blueprint $table) {
            $table->id();
            $table->string(column: 'name', length: 100);
            $table->string(column: 'slug', length: 120)->nullable();
            $table->boolean(column: 'status')->default(1)->comment('0:Inactive, 1:Active');
            $table->boolean(column: 'is_primary')->default(1)->comment('0:others, 1:primary');
            $table->tinyText(column: 'short_description')->nullable();
            $table->string(column: 'course_color_code')->nullable();
            $table->string(column: 'background_color_code')->nullable();
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
        Schema::dropIfExists(table: 'course_categories');
    }
};
