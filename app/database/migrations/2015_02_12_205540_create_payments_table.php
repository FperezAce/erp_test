<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePaymentsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('payments', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('employee_id');
			$table->date('fecha');
                        $table->string('url_boleta');
                        $table->string('url_comprobante');
                        $table->integer('monto_bruto');
                        $table->integer('monto_liquido');
			$table->timestamps();
		});
	}
        
	public function down()
	{
		Schema::drop('payments');
	}

}
