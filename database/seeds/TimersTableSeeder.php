<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TimersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('timers')->insert([
            'title' => 'test',
            'min' => 60,
            'icon_id' => 0,
            'mode_id' => 1,
            'color' => 000000,
            'picture' => 'test',
            'user_id' => 0,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
    }
}
