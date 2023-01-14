<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
        \App\Models\Sector::factory(5)->create();
        \App\Models\Neighborhood::factory(200)->create();
        \App\Models\Cell::factory(100)->create();
        \App\Models\Member::factory(10)->create();
        \App\Models\BibleSchool::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
