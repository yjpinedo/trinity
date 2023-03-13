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

        $sectors = [
            ['name' => 'Adonais', 'color' => 'info'],
            ['name' => 'Beraca', 'color' => 'warning'],
            ['name' => 'Jehova Nissi', 'color' => 'white'],
            ['name' => 'Kyrios', 'color' => 'danger'],
            ['name' => 'Shalom', 'color' => 'indigo'],
        ];

        foreach ($sectors as $sector) {
            \App\Models\Sector::factory()->create([
                'name' => $sector['name'],
                'slug' => str($sector['name'])->slug(),
                'color' => $sector['color'],
            ])->each(function ($sector) {
                \App\Models\Neighborhood::factory(11)->create([
                    'sector_id' => $sector->id,
                ]);
            });
        }

        \App\Models\Cell::factory(10)->create()->each(function ($cell) {
            \App\Models\Member::factory(5)->create([
                'cell_id' => $cell->id,
                'neighborhood_id' => $cell->neighborhood->id,
            ]);
        });

        \App\Models\Member::factory(1050)->create();
        \App\Models\BibleSchool::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
