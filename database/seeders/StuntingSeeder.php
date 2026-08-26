<?php

namespace Database\Seeders;

use App\Models\IndividualData;
use Illuminate\Database\Seeder;

class StuntingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'nama_desa' => 'Desa Singaparna',
                'nama_anak' => 'Ahmad Fauzan',
                'umur_bulan' => 24,
                'tinggi_badan' => 78.50,
                'berat_badan' => 9.20,
                'alamat' => 'Kampung Sukamaju',
            ],
            [
                'nama_desa' => 'Desa Cikunir',
                'nama_anak' => 'Siti Aisyah',
                'umur_bulan' => 30,
                'tinggi_badan' => 84.00,
                'berat_badan' => 10.50,
                'alamat' => 'Kampung Cibatu',
            ],
            [
                'nama_desa' => 'Desa Sukaasih',
                'nama_anak' => 'Muhammad Rizky',
                'umur_bulan' => 36,
                'tinggi_badan' => 88.50,
                'berat_badan' => 11.00,
                'alamat' => 'Kampung Sukasari',
            ],
        ];

        foreach ($data as $item) {
            IndividualData::create($item);
        }
    }
}