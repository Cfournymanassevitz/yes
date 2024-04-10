<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */

    public function run()
    {
        // Créez d'abord des catégories
        Product::factory()->count(20)->create();

//        // Ensuite, créez des produits et attribuez à chaque produit une catégorie aléatoire
//        Product::factory()->count(50)->create()->each(function ($product) use ($categories) {
//            $product->category_id = $categories->random()->id;
//            $product->save();
//        });
    }
}
