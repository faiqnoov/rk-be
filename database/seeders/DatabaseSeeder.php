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
            'name' => 'moderno',
            'category_id' => 1
        ]);

        Brand::create([
            'name' => 'arizona',
            'category_id' => 1
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
            'image' => null,
            'name' => 'karpet moderno 210x310',
            'is_available' => true,
        ]);

        Product::create([
            'category_id' => 1,
            'brand_id' => 2,
            'size_id' => 2,
            'color_id' => 2,
            'image' => null,
            'name' => 'karpet paris 160x210',
            'is_available' => true,
        ]);

        // \App\Models\User::factory(10)->create();
    }
}
