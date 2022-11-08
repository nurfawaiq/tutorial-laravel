<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EdulevelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('edulevels')->insert([
            [
                'name' => 'TK Sederajat',
                'desc' => 'TK / RA',
            ],
            [
                'name' => 'SD Sederajat',
                'desc' => 'SD / MI',
            ],
            [
                'name' => 'SMP Sederajat',
                'desc' => 'SMP / MTs',
            ],
            [
                'name' => 'SMA Sederajat',
                'desc' => 'SMA / MA / SMK',
            ],
            [
                'name' => 'Kuliah',
                'desc' => 'S1 / S2',
            ],
        ]);
    }
}
