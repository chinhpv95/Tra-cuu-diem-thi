<?php

use Illuminate\Database\Seeder;

class YearsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('years')->insert([
            ['year_name' => 'Năm học 2009-2010', 'active' => 0],
            ['year_name' => 'Năm học 2010-2011', 'active' => 0],
            ['year_name' => 'Năm học 2000-2002', 'active' => 0],
            ['year_name' => 'Năm học 2002-2003', 'active' => 0],
            ['year_name' => 'Năm học 2003-2004', 'active' => 0],
            ['year_name' => 'Năm học 2004-2005', 'active' => 0],
            ['year_name' => 'Năm học 2015-2016', 'active' => 1],
        ]);
    }
}
