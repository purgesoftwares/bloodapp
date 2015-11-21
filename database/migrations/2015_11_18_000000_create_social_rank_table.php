<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSocialRankTable extends Migration {

    public function up()
    {
        Schema::create('social_rank', function(Blueprint $table) {
            $table->increments('id');
			$table->string('code');
			$table->integer('share_counts');
			$table->integer('accepted_invitation');
			$table->integer('social_rank');
            $table->timestamps();
            $table->integer('user_id')->unsigned();
        });

        Schema::table('social_rank', function(Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users')
                    ->onDelete('restrict')
                    ->onUpdate('restrict');
        });
    }

    public function down()
    {
        Schema::table('social_rank', function(Blueprint $table) {
            $table->dropForeign('social_rank_user_id_foreign');
        });

        Schema::drop('social_rank');
    }

}
