<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->integer('cat_id');
            $table->integer('brand_id');
            $table->string('product_name');
            $table->text('product_desc');
            $table->text('product_specs');
            $table->float('before_price');
            $table->float('after_pprice');
            $table->string('product_code');
            $table->string('product_color');
            $table->string('product_size');
            $table->string('product_img');
            $table->tinyInteger('is_featured');
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
        Schema::dropIfExists('products');
    }
}
