<?php

namespace Database\Seeders;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Color;
use App\Models\Product;
use App\Models\Size;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Category::create([
            'name' => 'karpet'
        ]);

        Brand::create([
            'name' => 'moderno'
        ]);

        Brand::create([
            'name' => 'arizona'
        ]);

        Size::create([
            'name' => '210x310'
        ]);

        Size::create([
            'name' => '160x210'
        ]);

        Color::create([
            'name' => 'coklat'
        ]);

        Color::create([
            'name' => 'biru'
        ]);

        Product::create([
            'category_id' => 1,
            'brand_id' => 1,
            'size_id' => 1,
            'color_id' => 1,
            'image' => 'img_placeholder.jpg',
            'name' => 'karpet moderno 210x310',
        ]);

        Product::create([
            'category_id' => 1,
            'brand_id' => 2,
            'size_id' => 2,
            'color_id' => 2,
            'image' => 'img_placeholder.jpg',
            'name' => 'karpet arizona 160x210',
        ]);

        // \App\Models\User::factory(10)->create();
    }
}
