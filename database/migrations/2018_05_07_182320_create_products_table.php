<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('model', 100);
            $table->integer('price_per_hour')->comment('Price per hour for car rental. Stores in cents.');
            $table->unsignedInteger('branch_id')->comment('In which branch car currently placed');
            $table->unsignedInteger('product_type_id');
            $table->boolean('is_active')->default(1);
            $table->timestamps();
            $table->foreign('branch_id')
                    ->references('id')
                    ->on('branches')
                    ->onDelete('restrict');
            $table->foreign('product_type_id')
                    ->references('id')
                    ->on('product_types')
                    ->onDelete('restrict');
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
