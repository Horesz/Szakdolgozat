<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            ['name' => 'consoles', 'image' => 'consoles.png'],
            ['name' => 'Számítógép', 'image' => 'computer.png'],
            ['name' => 'Laptop', 'image' => 'laptop.png'],
            ['name' => 'Perifériák', 'image' => 'peripherals.png'],
            ['name' => 'Játékszoftver', 'image' => 'games.png'],
            ['name' => 'Monitor', 'image' => 'monitor.png'],
            ['name' => 'Egér', 'image' => 'mouse.png'],
            ['name' => 'Billentyűzet', 'image' => 'keyboard.png'],
            ['name' => 'Fejhallgató', 'image' => 'Headphones.png'],
            ['name' => 'Fülhallgató', 'image' => 'earbuds.png'],
            ['name' => 'Videókártya', 'image' => 'gpu.png'],
            ['name' => 'Memória', 'image' => 'memory.png'],
            ['name' => 'telefon', 'image' => 'telefon.png'],
        ];

        foreach ($categories as $category) {
            Category::firstOrCreate([
                'name' => $category['name']
            ], [
                'slug' => Str::slug($category['name']), // Automatikusan generálunk egy slug értéket
                'image' => $category['image'] // Hozzáadjuk a képet
            ]);
        }
    }
}