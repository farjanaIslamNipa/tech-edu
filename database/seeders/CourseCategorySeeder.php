<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CourseCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table(table: 'course_categories')->insert([
            [
                'id'                => 1,
                'name'              => "Kids Learning",
                'slug'              => "kids-learning",
                'status'            => 1,
                'short_description' => "",
                'created_at'        => now(),
                'updated_at'        => now(),
            ],
            [
                'id'                => 2,
                'name'              => "Parents Learning",
                'slug'              => "parents-learning",
                'status'            => 1,
                'short_description' => "",
                'created_at'        => now(),
                'updated_at'        => now(),
            ],
            [
                'id'                => 3,
                'name'              => "Family Learning",
                'slug'              => "family-learning",
                'status'            => 0,
                'short_description' => "",
                'created_at'        => now(),
                'updated_at'        => now(),
            ],
            [
                'id'                => 4,
                'name'              => "Senior Learning",
                'slug'              => "senior-learning",
                'status'            => 1,
                'short_description' => "",
                'created_at'        => now(),
                'updated_at'        => now(),
            ],


        ]);
    }
}
