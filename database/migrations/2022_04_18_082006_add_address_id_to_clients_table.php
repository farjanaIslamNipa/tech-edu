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
        Schema::table(table: 'clients', callback: function (Blueprint $table) {
            $table->foreignId(column: 'address_id')->after('id')->nullable()->comment('addresses table id');

            $table->foreign(columns: 'address_id')
                ->references('id')
                ->on('addresses')
                ->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table(table: 'clients', callback: function (Blueprint $table) {
            $table->dropForeign(['address_id']);
            $table->dropColumn(columns: 'address_id');
        });
    }
};
