<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBillsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('bills', function($table){
                   
                    $table->increments('id');
                             
                    $table->integer('project_id'); 
                    $table->string('numero');
                    $table->date('fecha_emision')->nullable();;
                    $table->decimal('monto', 11, 2);
                    $table->string('hito');
                    $table->date('fecha_cancelado')->nullable();;
                    $table->decimal('ppm', 11, 2);
                    $table->decimal('porcentaje',11,2);
                    $table->decimal('monto_alianza', 11, 2);
                    $table->string('numero_alianza');
                    $table->integer('factura_recibida');
                    $table->integer('pagado');
                    $table->string('url', 255)->nullable();
                    $table->string('url_comprobante', 255)->nullable();
                    $table->string('url_frecibida', 255)->nullable();
                    $table->string('url_comprobantefr', 255)->nullable();
                  
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
		Schema::drop('bills');
	}

}
