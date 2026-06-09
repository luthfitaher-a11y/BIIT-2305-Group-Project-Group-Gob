<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = ['footwear', 'apparel', 'ball', 'equipment', 'acc'];

        foreach ($categories as $name) {
            Category::create(['name' => $name]);
        }
    }
}