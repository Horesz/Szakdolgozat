<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
            [
                'name' => 'Gaming PC',
                'description' => 'Erőteljes gaming számítógépek a legjobb játékélményért.',
                'status' => 'active',
            ],
            [
                'name' => 'Konzolok',
                'description' => 'Népszerű játékkonzolok és kiegészítőik.',
                'status' => 'active',
            ],
            [
                'name' => 'Gamer Monitorok',
                'description' => 'Magas frissítési rátájú és válaszidejű gamer monitorok.',
                'status' => 'active',
            ],
            [
                'name' => 'Gamer Billentyűzetek',
                'description' => 'Mechanikus és membránbillentyűzetek gamereknek.',
                'status' => 'active',
            ],
            [
                'name' => 'Gamer Egerek',
                'description' => 'Nagy pontosságú és testreszabható egerek.',
                'status' => 'active',
            ],
            [
                'name' => 'Gamer Fejhallgatók',
                'description' => 'Kiváló hangminőségű vezetékes és vezeték nélküli fejhallgatók.',
                'status' => 'active',
            ],
            [
                'name' => 'Videójátékok',
                'description' => 'A legújabb és klasszikus játékok több platformra.',
                'status' => 'active',
            ],
            [
                'name' => 'Gamer Székek',
                'description' => 'Kényelmes gamer székek hosszú játékmenetekhez.',
                'status' => 'active',
            ],
            [
                'name' => 'Számítógép Alkatrészek',
                'description' => 'Processzorok, videokártyák, memóriák és más alkatrészek.',
                'status' => 'active',
            ],
            [
                'name' => 'Gamer Kiegészítők',
                'description' => 'Egérpadok, kontroller töltők és egyéb kiegészítők.',
                'status' => 'active',
            ],
        ];

        foreach ($categories as $category) {
            Category::create([
                'name' => $category['name'],
                'slug' => Str::slug($category['name']),
                'description' => $category['description'],
                'status' => $category['status'],
                'image' => 'images/categories/default.png', // Alapértelmezett kép
            ]);
        }
    }
}