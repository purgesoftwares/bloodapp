<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function(Blueprint $table) {
            $table->increments('id');
            $table->string('name');
			$table->string('email')->unique();
            $table->string('password', 60);
            $table->boolean('admin')->default(false);
            $table->integer('city_id')->unsigned();
			$table->integer('social_rank_id')->unsigned();
			$table->string('blood_group');
			$table->string('last_donation_date');
			$table->string('height');
			$table->string('weight');
			$table->string('age');
			$table->string('mobile');
			$table->string('is_eligible');
			$table->string('last_ill_date');
            $table->rememberToken();
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
        Schema::drop('users');
    }

}
