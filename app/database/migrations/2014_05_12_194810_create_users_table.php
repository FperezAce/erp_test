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
                Schema::create('users', function($table){
                   
                    $table->increments('id');
                    $table->string('name', 100);
                    $table->string('last_name', 100);
                    $table->string('email', 100)->unique();
                    $table->string('address', 255);
                    $table->integer('phone');
                    $table->string('username')->unique();
                    $table->string('password', 60);
					$table->string('password_temp', 60)->nullable();
                    $table->string('code')->nullable();
                    $table->integer('active');
                    $table->string('remember_token', 100)->nullable();
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
