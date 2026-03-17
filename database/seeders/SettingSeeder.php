<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\Setting::updateOrCreate(
            ['id' => 1],
            [
                'title' => 'Sumbar Fakta',
                'tagline' => 'Cerdas Tajam Terpercaya',
                'email' => 'admin@sumbarfakta.com',
                'favicon'   => null,
            ]
        );
    }
}
