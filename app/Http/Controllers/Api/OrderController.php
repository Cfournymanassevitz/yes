<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\StoreOrderRequest;
use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     * This method retrieves all orders from the database.
     */
    public function index(): \Illuminate\Database\Eloquent\Collection
    {
        return Order::all();
    }

    /**
     * Store a newly created resource in storage.
     * This method stores a new order in the database.
     * It first validates the request data, then creates a new order with these data and saves it in the database.
     */
    public function store(StoreOrderRequest $request)
    {
        $validated = $request->validated();
        $order = Order::create($validated);
        return $order;
    }

    /**
     * Display the specified resource.
     * This method retrieves a specific order from the database using the provided ID.
     */
    public function show(Order $order)
    {
        return $order->with('products')->where('id', $order->id)->get();
    }

    /**
     * Update the specified resource in storage.
     * This method updates a specific order.
     * It first validates the request data, then updates the order with the validated data.
     */
    public function update(StoreOrderRequest $request, Order $order)
    {
        $validated = $request->validated();
        $order->update($validated);
        return $order;
    }

    /**
     * Remove the specified resource from storage.
     * This method deletes a specific order.
     * It first retrieves the order from the database using the provided ID, then deletes the order.
     */
    public function destroy(Order $order)
    {
        $order->delete();
        return response()->json(null, 204);
    }
}
