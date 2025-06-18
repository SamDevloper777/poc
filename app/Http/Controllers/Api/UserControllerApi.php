<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserControllerApi extends Controller
{
    public function login(Request $request)
    {
        $user = User::where('email', $request->email)->first();

        if (! $user || ! Hash::check($request->password, $user->password)) {
            return response()->json(['message' => 'Invalid credentials'], 401);
        }

        $token = $user->createToken('api-token')->plainTextToken;

        return response()->json(['token' => $token, 'user' => $user,"message" => "Login successful"], 200,);
    }

    // Fetch paginated users
    public function index(Request $request)
    {
        $users = User::select(
            'id', 'first_name', 'last_name', 'email', 'phone',
            'date_of_birth', 'address', 'city', 'country',
            'occupation', 'status', 'created_at'
        )->paginate(10);

        return response()->json([
            'status' => true,
            'message' => 'User list fetched successfully',
            'data' => $users
        ]);
    }
}
