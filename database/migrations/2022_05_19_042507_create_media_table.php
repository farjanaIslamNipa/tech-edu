<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMediaTable extends Migration
{
    public function up()
    {
        Schema::create(table: 'media', callback: function (Blueprint $table) {
            $table->bigIncrements(column: 'id');

            $table->morphs(name: 'model');
            $table->uuid(column:'uuid')->nullable()->unique();
            $table->string(column:'collection_name');
            $table->string(column:'name');
            $table->string(column:'file_name');
            $table->string(column:'mime_type')->nullable();
            $table->string(column:'disk');
            $table->string(column:'conversions_disk')->nullable();
            $table->unsignedBigInteger(column:'size');
            $table->json(column:'manipulations');
            $table->json(column:'custom_properties');
            $table->json(column:'generated_conversions');
            $table->json(column:'responsive_images');
            $table->unsignedInteger(column:'order_column')->nullable()->index();

            $table->nullableTimestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists(table: 'media');
    }
}
