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
        Schema::create(table: 'package_types', callback: function (Blueprint $table) {
            $table->id();
            $table->string(column: 'type')->comment('example:6 hours, 10 hours, 20 hours');
            $table->tinyInteger(column: 'minimum_course_count')->default(3);
            $table->float(column: 'discount_percentage')->nullable()->comment('example:20% discount');
            $table->boolean(column: 'status')->default(1)->comment('0:Inactive, 1:Active');
            $table->text(column: 'payment_link')->nullable();
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
        Schema::dropIfExists(table: 'package_types');
    }
};
