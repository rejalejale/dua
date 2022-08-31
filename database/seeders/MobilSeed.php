<?php

namespace Database\Seeders;

use App\Models\mobil;
use Illuminate\Database\Seeder;

class MobilSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            [
                'model'            => 'contoh',
            ],
        ];

        mobil::insert($users);
    }
}
