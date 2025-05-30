<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\UserModel;

class UserController extends Controller
{
    public function index()
    {
        return UserModel::all();
    }

    public function store(Request $request)
    {
        $user = UserModel::create($request->all());

        return response()->json($user, 201);
    }

    public function show($id)
    {
        return UserModel::find($id);
    }

    public function update(Request $request, UserModel $user)
    {
        $user->update($request->all());

        return response()->json([
            'success' => true,
            'message' => 'Data Successfully Updated',
            'data' => $user,
        ]);
    }

    public function destroy(UserModel $user)
    {
        $user->delete();

        return response()->json([
            'success' => true,
            'message' => 'Data Successfully Deleted',
        ]);
    }
}