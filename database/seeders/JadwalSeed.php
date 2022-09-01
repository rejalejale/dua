<?php

namespace Database\Seeders;

use App\Models\jadwal;
use Illuminate\Database\Seeder;

class JadwalSeed extends Seeder
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
                'nama'            => 'contoh',
                'mobil'           => 'contoh',
                'keterangan'      => 'contoh',
                'tujuan'          => 'contoh',
                'bidang'          => 'contoh',
                'status'          => 'contoh',
                'berangkat'       => '2022-08-26 09:30:00',
                'pulang'          => '2022-08-28 09:30:00',
            ],
        ];

        jadwal::insert($users);
    }
}
