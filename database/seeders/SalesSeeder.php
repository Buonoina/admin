<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SalesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('sales')->insert([
            [
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => null,
                'product_id'=> 1,
            ],
            [
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => null,
                'product_id'=> 2,
            ],
            [
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => null,
                'product_id'=> 3,
            ],
        ]);
    }
}

