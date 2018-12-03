<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProjectsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('projects', function($table){
                   
                    $table->increments('id');
                    
                    $table->integer('customer_id');
                    $table->integer('situation_id');
                    $table->string('nombre', 255);
                    $table->string('orden_compra', 255);
                    $table->date('fecha_orden_compra');
                    $table->string('item_comprado', 255);
                    $table->decimal('valor', 13, 2);
                    $table->decimal('valor_uf', 9, 2);
                    $table->integer('numero_hitos');
                    $table->string('pdf', 255)->nullable();
                    $table->integer('type');
                    $table->string('nombre_alianza', 255);
                    $table->integer('porcentaje_alianza');
                    
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
		Schema::drop('projects');
	}

}
