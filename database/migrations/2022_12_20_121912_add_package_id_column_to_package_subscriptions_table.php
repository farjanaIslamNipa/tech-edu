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
        Schema::table(table: 'package_subscriptions', callback: function (Blueprint $table) {
            $table->foreignId(column: 'package_id')->after('id')->comment('packages table id');

            $table->foreign(columns: 'package_id')
                ->references('id')
                ->on('packages')
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
        Schema::table(table: 'package_subscriptions', callback: function (Blueprint $table) {
            $table->dropForeign(['package_id']);
            $table->dropColumn(columns: 'package_id');
        });
    }
};
