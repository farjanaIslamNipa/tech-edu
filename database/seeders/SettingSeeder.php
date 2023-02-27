<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table(table: 'settings')->insert([
            [
                'type'          => 'notice',
                'key'           => 'notice_home_page_top',
                'value'         => '{"status":1,"notice":"Enrolments Closing Soon: Holiday program is available near you! Book today."}',
                'json_encoded'  => 1,
                'description'   => 'Default home page top notice',
            ],
        ]);
    }
}
