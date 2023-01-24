<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Neighborhood;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        //Storage::deleteDirectory('public/sectors');
        //Storage::makeDirectory('public/sectors');
        \App\Models\User::factory()->create([
            'name' => 'Administrator',
            'email' => 'admin@admin.com'
        ]);

        $nameSector = [
            'Adonais',
            'Beraca',
            'Jehova Nissi',
            'Kyrios',
            'Shalom',
        ];

        foreach ($nameSector as $value) {
            \App\Models\Sector::factory()->create([
                'name' => $value,
                'slug' => str($value)->slug(),
            ])->each(function ($sector) {
                \App\Models\Neighborhood::factory(11)->create([
                    'sector_id' => $sector->id,
                ]);
            });
        }

        \App\Models\Cell::factory(50)->create()->each(function ($cell) {
            \App\Models\Member::factory(5)->create([
                'cell_id' => $cell->id,
                'neighborhood_id' => $cell->neighborhood->id,
            ]);
        });

        \App\Models\Member::factory(100)->create();
        \App\Models\BibleSchool::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
