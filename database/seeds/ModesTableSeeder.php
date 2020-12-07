<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Mode;

class ModesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Eloquent::unguard();
        // 全部消す
        DB::table('modes')->delete();

        Mode::create([
            'id' => 1,
            'mode_name' => 'normal',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        Mode::create([
            'id' => 2,
            'mode_name' => 'dark',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
    }
}