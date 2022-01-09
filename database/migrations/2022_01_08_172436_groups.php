<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Groups extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('affinity_group', function (Blueprint $table) {
            $table->id();
            $table->string('group');
        });

        Schema::create('affinity_group_user', function (Blueprint $table) {
            $table->id();
            $table->integer('group_id');
            $table->integer('user_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('group');
        Schema::drop('group_user');
    }
}
