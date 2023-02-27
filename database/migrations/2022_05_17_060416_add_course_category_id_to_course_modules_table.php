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
        Schema::table(table: 'course_modules', callback: function (Blueprint $table) {
            $table->foreignId(column: 'course_category_id')->after('id')->comment('course categories table id');

            $table->foreign(columns: 'course_category_id')
                ->references('id')
                ->on('course_categories')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table(table: 'course_modules', callback: function (Blueprint $table) {
            $table->dropForeign(['course_category_id']);
            $table->dropColumn(columns: 'course_category_id');
        });
    }
};
