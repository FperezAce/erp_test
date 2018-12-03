<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProposalDetailsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('proposal_details', function($table){
                   
                    $table->increments('id');
                    
                    $table->integer('proposal_id'); 
                    $table->decimal('cantidad', 11, 2);
                    $table->date('fecha');
                    $table->decimal('valor_uf', 11,2);
                    $table->decimal('horas_diarias', 11, 2);
                    $table->integer('numero_dias');
                    $table->decimal('horas_totales', 11, 2);
                    $table->decimal('total', 11, 2);
                    $table->decimal('ppm', 11, 2);
                    $table->decimal('gastos_asociados', 11, 2);
                    $table->decimal('utilidad', 11, 2);
                    $table->string('nombre', 255);
                    
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
		Schema::drop('proposal_details');
	}

}
