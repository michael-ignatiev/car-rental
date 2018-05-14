<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserActionUserRoleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_action_user_role', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->unsignedInteger('user_action_id');
            $table->unsignedInteger('user_role_id');
            $table->timestamps();
            
            $table->foreign('user_action_id')
                    ->references('id')
                    ->on('user_actions')
                    ->onDelete('restrict');
            $table->foreign('user_role_id')
                    ->references('id')
                    ->on('user_roles')
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
        Schema::dropIfExists('user_action_user_role');
    }
}
