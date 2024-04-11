<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreStoreRequest;
use App\Http\Requests\UpdateStoreRequest;
use App\Models\Store;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Auth;
use Validator;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function loginUser(Request $request): Response
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if($validator->fails()){

            return Response(['message' => $validator->errors()],401);
        }

        if(Auth::attempt($request->all())){

            $user = Auth::user();

            $success =  $user->createToken('MyApp')->plainTextToken;

            return Response(['token' => $success],200);
        }

        return Response(['message' => 'email or password wrong'],401);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function userDetails(): Response
    {
        if (Auth::check()) {

            $user = Auth::user();

            return Response(['data' => $user],200);
        }

        return Response(['data' => 'Unauthorized'],401);
    }

    /**
     * Display the specified resource.
     */
    public function logout(): Response
    {
        $user = Auth::user();

        $user->currentAccessToken()->delete();

        return Response(['data' => 'User Logout successfully.'],200);
    }

    public function index(): \Illuminate\Database\Eloquent\Collection
    {
       return User::all();
    }

    /**
     * Show the form for creating a new resource.
     * @param $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function create($request)
    {
       $request->validate([
                'name' => 'required',
                'email' => 'required',
                'password' => 'required',
            ]);
            $User = new User();
            $User->name = $request->input('name');
            $User->email = $request->input('email');
            $User->password = $request->input('password');
            $User->save();
            return response()->json(['message' => 'User created successfully'], 200);
    }

    /**
     * Store a newly created resource in storage.
     */

    public function store(StoreStoreRequest $request)
    {
        $User = User::create($request->all());
    }

    /**
     * Display the specified resource.
     * @param Store $store
     * @param $id
     * @return mixed
     */
    public function show(Store $store, $id)
    {
        return $User = User::find($id);
    }


    /**
     * Update the specified resource in storage.
     * @param UpdateStoreRequest $request
     * @param Store $store
     * @param $id
     */

    public function update(UpdateStoreRequest $request, Store $store, $id)
    {
        $this->authorize('update-articles');

        $User = User::find($id);
        $User->update($request->all());
        return $User;
    }

    /**
     * Remove the specified resource from storage.
     * @param Store $store
     * @param $id
     */
    public function destroy(Store $store, $id): void
    {
        $User = User::find($id);
        $User->delete();
    }
}
