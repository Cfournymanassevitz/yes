<?php

namespace Database\Seeders;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Database\Seeder;

class OrderProductSeeder extends Seeder
{
    public function run()
    {
       $order = Order::all()->first();
       $product = Product::all()->first();
         $order->products()->attach($product->id, ['quantity'=> 2]);


    }
}
