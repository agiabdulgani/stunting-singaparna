<?php

namespace Database\Seeders;

use App\Models\SupportData;
use App\Models\TargetData;
use Illuminate\Database\Seeder;

class VillageDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // ==========================================
        // 1. DATA SASARAN DESA
        // ==========================================

        $targetData = [
            [
                'village_name'       => 'Singaparna',
                'population_count'   => 12500,
                'family_count'       => 3100,
                'young_female_count' => 850,
                'children_count'     => 2400,
            ],
            [
                'village_name'       => 'Cikunir',
                'population_count'   => 9800,
                'family_count'       => 2450,
                'young_female_count' => 620,
                'children_count'     => 1850,
            ],
            [
                'village_name'       => 'Cintaraja',
                'population_count'   => 8400,
                'family_count'       => 2100,
                'young_female_count' => 540,
                'children_count'     => 1600,
            ],
        ];

        foreach ($targetData as $data) {
            TargetData::updateOrCreate(
                [
                    'village_name' => $data['village_name'],
                ],
                $data
            );
        }

        // ==========================================
        // 2. DATA PENDUKUNG DESA
        // ==========================================

        $supportData = [
            [
                'village_name'           => 'Singaparna',
                'paud_institution_count' => 6,
                'smp_mts_count'          => 3,
                'sma_ma_count'           => 2,
                'paud_teacher_count'     => 18,
            ],
            [
                'village_name'           => 'Cikunir',
                'paud_institution_count' => 4,
                'smp_mts_count'          => 2,
                'sma_ma_count'           => 1,
                'paud_teacher_count'     => 12,
            ],
            [
                'village_name'           => 'Cintaraja',
                'paud_institution_count' => 3,
                'smp_mts_count'          => 1,
                'sma_ma_count'           => 1,
                'paud_teacher_count'     => 9,
            ],
        ];

        foreach ($supportData as $data) {
            SupportData::updateOrCreate(
                [
                    'village_name' => $data['village_name'],
                ],
                $data
            );
        }
    }
}