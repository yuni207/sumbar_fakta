<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Setting;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        Setting::updateOrCreate(
            ['id' => 1], // Unik: hanya ada satu setting
            [
                'title'     => 'Sumbar Fakta',
                'tagline'   => 'Cerdas, Tajam, Terpercaya',
                'email'     => 'redaksi@sumbarfakta.com',
                'favicon'   => null,
                // Tambahkan field lain jika ada yang bersifat NOT NULL
            ]
        );

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
