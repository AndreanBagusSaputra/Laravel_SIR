<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StaffSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // disini adalah proses untuk seeder atau pengisian data  menggunakan sintaks php
        for ($i = 0; $i < 10; $i++) {
            DB::table('staff')->insert(
                [
                    'id' => rand(),
                    'nip' => 's'.rand(10,99),
                    'name' => ('name_'),
                    'gender' => ('L'),
                    'alamat' => ('alamat_'),
                    'email' => uniqid().'@gmail.com',
                    'foto' => ('foto_'),
                    'created_at' => new \Datetime,
                    'updated_at' => null,
                ]
            );
        }
    }
}
