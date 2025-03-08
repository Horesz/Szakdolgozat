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
            ['name' => 'Konzol'],
            ['name' => 'Számítógép'],
            ['name' => 'Laptop'],
            ['name' => 'Perifériák'],
            ['name' => 'Játékszoftver'],
            ['name' => 'Kiegészítők'],
        ];

        foreach ($categories as $category) {
            Category::firstOrCreate([
                'name' => $category['name']
            ], [
                'slug' => Str::slug($category['name']) // Automatikusan generálunk egy slug értéket
            ]);
        }
    }
}
