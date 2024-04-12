<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreStoreRequest;
use App\Http\Requests\UpdateStoreRequest;
use App\Models\Store;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class StoreController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): \Illuminate\Database\Eloquent\Collection
    {
        return Store::all();
    }

    /**
     * Show the form for creating a new resource.
     * @param $request
     */
    public function create($request)
    {
        $request->validate([
            'name' => 'required',
            'theme' => 'required',
            'biography' => 'required',
        ]);
        $shop = new Store();
        $shop->name = $request->input('name');
        $shop->theme = $request->input('theme');
        $shop->biography = $request->input('biography');
        $shop->save();
        return response()->json(['message' => 'Shop created successfully'], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
//        $request->validate([
//            'name' => 'required',
//            'theme' => 'required',
//            'biography' => 'required',
//        ]);
//        dd($request->all());
//        $shop = new Store();
        $shop = Store::create(
            array_merge
            (
                $request->all(),
                ['user_id' => Auth::id()]
            )
        );
//        $shop->name = $request->input('name');
//        $shop->theme = $request->input('theme');
//        $shop->biography = $request->input('biography');
//        $shop->user_id = Auth::id();
        $shop->save();
        return response()->json(['message' => 'Shop created successfully'], 200);
    }

    /**
     * Display the specified resource.
     * @param Store $store
     * @param $id
     * @return mixed
     */
    public function show(Store $store, $id): mixed
    {
        return $Store = Store::find($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateStoreRequest $request, $id)
    {

        $store = Store::find($id);
        $store->update($request->all());
        return $store;
    }

    /**
     * Remove the specified resource from storage.
     * @param Store $store
     * @param $id
     */
    public function destroy(Store $store, $id): void
    {
        $store = Store::find($id);
        $store->delete();
    }
}
