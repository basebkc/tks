<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;

class PendidikanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('pendidikan')->insert([
            [
                'pendidikan' => 'SD',
                'keterangan' => 'Sekolah Dasar',
            ],
            [
                'pendidikan' => 'SMP',
                'keterangan' => 'Sekolah Menengah Pertama',
            ],
            [
                'pendidikan' => 'SMA',
                'keterangan' => 'Sekolah Menengah Atas',
            ],
            [
                'pendidikan' => 'Diploma',
                'keterangan' => 'Diploma',
            ],
            [
                'pendidikan' => 'S1',
                'keterangan' => 'Strata Satu',
            ],
            [
                'pendidikan' => 'S2',
                'keterangan' => 'Strata Dua',
            ],
            [
                'pendidikan' => 'S3',
                'keterangan' => 'Strata Tiga',
            ],
        ]);
    }
}
