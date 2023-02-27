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
        Schema::create(table: 'package_subscriptions', callback: function (Blueprint $table) {
            $table->id();
            $table->string(column: 'reference', length: 50)->nullable();
            $table->float(column: 'package_price')->default( 0)->comment('Price in cents');
            $table->float(column: 'discount_price')->default( 0)->comment('Price in cents');
            $table->float(column: 'gst_price')->default( 0);
            $table->float(column: 'total_price')->default( 0)->comment('Price in cents');
            $table->boolean(column: 'payment_status')->default(0)->comment('0:Unpaid, 1:Paid');
            $table->boolean(column: 'subscription_status')->default(0)->comment('0:Inactive, 1:Active, 2:Suspend');
            $table->dateTime(column: 'subscription_end_date')->nullable();
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
        Schema::dropIfExists(table: 'package_subscriptions');
    }
};
