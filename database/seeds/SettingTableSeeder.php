<?php

use Illuminate\Database\Seeder;

class SettingTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('general_setting')->insert
        ([
            ['option' => 'radius', 'value' => '{"username":" ","password":" ","secret":" "}'], ['option' => 'bandwith', 'value' => '{"up":"","down_active":"no","down":"","timeout":"","up_active":"no","timeout_active":"no"}']
        ]);
    }
}
