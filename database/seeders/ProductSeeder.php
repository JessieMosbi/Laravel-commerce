<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Product::upsert([
            'id' => 1,
            'title' => '測試產品 1',
            'content' => '測試產品內容 1',
            'price' => rand(0, 300),
            'quantity' => 10
        ], ['id'], ['price', 'quantity']);

        Product::create([
            'title' => '測試產品 2',
            'content' => '測試產品內容 2',
            'price' => rand(0, 300),
            'quantity' => 10
        ]);
    }
}
