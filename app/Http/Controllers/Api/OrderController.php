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
     * This method retrieves all products from the database.
     * It also filters products based on 'name' and 'max_price' parameters from the request.
     * Finally, it sorts the products by price.
     */
    public function index(Request $request): \Illuminate\Database\Eloquent\Collection
    {
        // Start a new query
        $query = Product::query();

        // If a 'name' parameter is provided, filter products by name
        if ($request->has('name')) {
            $name = $request->input('name');
            $query->where('name', $name);
        }

        // If a 'max_price' parameter is provided, filter products by max price
        if ($request->has('max_price')) {
            $max_price = $request->input('max_price');
            $query->where('price', '<=', $max_price);
        }

        // Sort products by price
        $query->orderBy('price');

        // Return the result of the query
        return $query->get();
    }

    /**
     * This method creates a new product.
     * It first validates the request data, then creates a new product with these data and saves it in the database.
     */
    public function create($request)
    {
        // Validate the request data
        $request->validate([
            'name' => 'required',
            'price' => 'required',
            'description' => 'required',
        ]);

        // Create a new product and set its properties
        $product = new Product();
        $product->name = $request->input('name');
        $product->price = $request->input('price');
        $product->description = $request->input('description');

        // Save the product in the database
        $product->save();

        // Return a success message
        return response()->json(['message' => 'Product created successfully'], 200);
    }

    /**
     * Store a newly created resource in storage.
     * This method stores a new product in the database.
     * It first retrieves the product's category from the request, then creates the product with all request data.
     */
    public function store(Request $request)
    {
        // Get the category ID from the request
        $category_id = $request->input('category_id');

        // Find the category in the database
        $category = Category::find($category_id);

        // If the category is not found, return an error message
        if (!$category) {
            return response()->json(['message' => 'Category not found'], 404);
        }

        // Create the product with all request data
        Product::create($request->all());
    }

    /**
     * Display the specified resource.
     * This method retrieves a specific product from the database using the provided ID.
     */
    public function show(string $id)
    {
        // Find the product in the database and return it
        return $Product = Product::find($id);
    }

    /**
     * Update the specified resource in storage.
     * This method updates a specific product.
     * It first retrieves the product from the database using the provided ID, then updates the product with all request data.
     */
    public function update(Request $request, string $id)
    {
        // Find the product in the database
        $Product = Product::find($id);

        // Update the product with all request data
        $Product->update($request->all());

        // Return the updated product
        return $Product;
    }

    /**
     * Remove the specified resource from storage.
     * This method deletes a specific product.
     * It first retrieves the product from the database using the provided ID, then deletes the product.
     */
    public function destroy(string $id)
    {
        // Find the product in the database
        $Product = Product::find($id);

        // Delete the product
        $Product->delete();
    }

}
