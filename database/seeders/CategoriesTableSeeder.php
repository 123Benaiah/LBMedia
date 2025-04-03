<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    public function run()
    {
        // Define sample categories
        $categories = [
            ['name' => 'Music'],
            ['name' => 'Videos'],
            ['name' => 'Documents'],
            ['name' => 'Images'],
            ['name' => 'Podcasts'],
        ];

        // Insert categories into the database
        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
