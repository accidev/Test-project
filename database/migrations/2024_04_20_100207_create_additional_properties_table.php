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
        Schema::create('additional_properties', function (Blueprint $table) {
            $table->id();
            $table->string('size', 10)->nullable();
            $table->string('color', 50)->nullable();
            $table->string('brand')->nullable();
            $table->string('composition')->nullable();
            $table->integer('quantity_in_package')->nullable();
            $table->text('seo_title')->nullable();
            $table->string('seo_h1')->nullable();
            $table->text('seo_description')->nullable();
            $table->integer('product_weight')->nullable();
            $table->integer('product_width')->nullable();
            $table->integer('product_height')->nullable();
            $table->integer('product_length')->nullable();
            $table->integer('package_weight')->nullable();
            $table->integer('package_width')->nullable();
            $table->integer('package_height')->nullable();
            $table->integer('package_length')->nullable();
            $table->string('product_category')->nullable();
            $table->integer('product_id');
            $table->foreign('product_id')
                ->references('id')->on('products')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('additional_properties');
    }
};
