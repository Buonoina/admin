<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BunruisSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
            \DB::table('bunruis')->insert([
                [
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => null,
                    'str'=> '鉛筆',
                ],
                [
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => null,
                    'str'=> 'ボールペン',
                ],
                [
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => null,
                    'str'=> '消しゴム',
                ],
            ]);
    }
}
