<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('customers', function($table){
                   
                    $table->increments('id');
                    
                    $table->string('nombre', 100); 
                    $table->string('rut');
                    $table->string('mail', 100);
                    $table->string('fono');
                    $table->integer('tipo');
                                                 
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
		Schema::drop('customers');
	}

}
