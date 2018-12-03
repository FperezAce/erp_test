<?php

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Eloquent::unguard();

                
		 $this->call('UserTableSeeder');
                 $this->call('ProposalTableSeeder');
                 $this->call('CustomerTableSeeder');
                 $this->call('SituationTableSeeder');
                 $this->call('JobTypeTableSeeder');
                 $this->call('ContractTypeTableSeeder');
                 $this->call('JobTableSeeder');
                 $this->call('EmployeeTableSeeder');
                 
	}

}
