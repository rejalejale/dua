<?php

namespace Database\Seeders;

use App\Models\supir;
use Illuminate\Database\Seeder;

class SupirSeed extends Seeder
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
                'nama'           => 'contoh',
                'nomor'          => '123',
                'warna'          => '#16a413',
            ],
        ];

        supir::insert($users);
    }
}
