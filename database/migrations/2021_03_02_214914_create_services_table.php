<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('services', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('image');
            $table->text('address');
            $table->double('rating');
            $table->double('latitude')->nullable();
            $table->double('longitude')->nullable();
            $table->unsignedBigInteger('city_id');
            $table->unsignedBigInteger('category_id');
            $table->timestamps();

            //foreing key constraint
            $table->foreign('city_id')->references('id')->on('cities')
                                    ->onDelete('cascade');
            //foreing key constraint
            $table->foreign('category_id')->references('id')->on('categories')
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
        Schema::dropIfExists('services');
    }
}
