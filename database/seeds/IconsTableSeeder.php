<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Icon;

class IconsTableSeeder extends Seeder
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
        DB::table('icons')->delete();

        Icon::create([
            'id' => 1,
            'icon_name' => 'square',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        Icon::create([
            'id' => 2,
            'icon_name' => 'heart',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        Icon::create([
            'id' => 3,
            'icon_name' => 'tint',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        Icon::create([
            'id' => 4,
            'icon_name' => 'star',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
    }
}
