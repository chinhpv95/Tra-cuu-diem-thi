<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder {
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run() {
		DB::table( 'users' )->insert( [
			[
				'name'     => 'Quản trị viên',
				'email'    => 'admin@gmail.com',
				'password' => bcrypt( '123456' ),
				'is_admin' => 1
			],
			[
				'name'     => 'Trinh Duc Dai',
				'email'    => 'daitd58@gmail.com',
				'password' => bcrypt( '123456' ),
				'is_admin' => ''
			]
		] );
	}
}
