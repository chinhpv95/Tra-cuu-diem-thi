<?php

use Illuminate\Database\Seeder;

class SemestersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('semesters')->insert([
            ['semester_name' => 'Học kỳ I', 'active' => 1],
            ['semester_name' => 'Học kỳ phụ kỳ I', 'active' => 0],
            ['semester_name' => 'Học kỳ II', 'active' => 0],
            ['semester_name' => 'Học kỳ phụ kỳ II', 'active' => 0],
            ['semester_name' => 'Học kỳ hè', 'active' => 0],
        ]);
    }
}
