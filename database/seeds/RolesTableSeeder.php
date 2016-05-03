<?php

use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert([
            ['name' => 'Cập nhật danh sách'],
            ['name' => 'Cập nhật điểm'],
            ['name' => 'Quản lí thành viên'],
            ['name' => 'Quản lí năm học'],
        ]);
    }
}
