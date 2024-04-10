<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;


class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): \Illuminate\Database\Eloquent\Collection
    {
        $query = Product::query();

        if ($request->has('name')) {
            $name = $request->input('name');
            $query->where('name', $name);
        }


        if ($request->has('max_price')) {
            $max_price = $request->input('max_price');
            $query->where('price', '<=', $max_price);
        }

        // Trier les produits par prix
        $query->orderBy('price');

        return $query->get();
    }
    public function create($request)
    {
        $request->validate([
            'name' => 'required',
            'price' => 'required',
            'description' => 'required',
        ]);

        $product = new Product();
        $product->name = $request->input('name');
        $product->price = $request->input('price');
        $product->description = $request->input('description');
        $product->save();
        return response()->json(['message' => 'Product created successfully'], 200);
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $category_id = $request->input('category_id');
        $category = Category::find($category_id);

        if (!$category) {
            return response()->json(['message' => 'Category not found'], 404);
        }

        Product::create($request->all());
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return $Product = Product::find($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $Product = Product::find($id);
        $Product->update($request->all());
        return $Product;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $Product = Product::find($id);
        $Product->delete();
    }
}
