<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('product_id');
            $table->unsignedInteger('branch_to_take_from_id')->comment('Branch from which car was taken');
            $table->unsignedInteger('branch_to_return_to_id')->comment('Branch to which car was returned');
            $table->unsignedInteger('rental_plan_id');
            $table->unsignedInteger('payment_type_id');
            $table->unsignedInteger('payment_status_id');
            $table->integer('price');
            $table->unsignedInteger('discount_id')->nullable();
            $table->integer('total');
            $table->text('comment');
            $table->timestamps();
            
            $table->foreign('user_id')
                    ->references('id')
                    ->on('users')
                    ->onDelete('restrict');
            $table->foreign('product_id')
                    ->references('id')
                    ->on('products')
                    ->onDelete('restrict');
            $table->foreign('branch_to_take_from_id')
                    ->references('id')
                    ->on('branches')
                    ->onDelete('restrict');
            $table->foreign('branch_to_return_to_id')
                    ->references('id')
                    ->on('branches')
                    ->onDelete('restrict');
            $table->foreign('rental_plan_id')
                    ->references('id')
                    ->on('rental_plans')
                    ->onDelete('restrict');
            $table->foreign('payment_type_id')
                    ->references('id')
                    ->on('payment_types')
                    ->onDelete('restrict');
            $table->foreign('payment_status_id')
                    ->references('id')
                    ->on('payment_statuses')
                    ->onDelete('restrict');
            $table->foreign('discount_id')
                    ->references('id')
                    ->on('discounts')
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
        Schema::dropIfExists('orders');
    }
}
