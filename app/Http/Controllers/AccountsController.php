<?php

namespace App\Http\Controllers;


use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;


class AccountsController extends Controller
{
    /**
     * Create new account
     */
    public function register(Request $request)
    {
        $fields = $request->validate([
            'email' => 'required|string|unique:users,email',
            'password' => 'required|string|confirmed',
            'first_name' => 'required|string',
            'last_name' => 'required|string'
        ]);

        $user = User::create([
            'email' => $fields['email'],
            'password' => bcrypt($fields['password']),
            'first_name' => $fields['first_name'],
            'last_name' => $fields['last_name']
        ]);

        
        $token = $user->createToken('apptoken')->plainTextToken;

        $response = [
            'user' => $user,
            'token' => $token
        ];

        return response($response, 201);
    }

    /**
     * Login
     */
    public function login(Request $request){
        $fields = $request->validate([
            'email' => 'required|string',
            'password' => 'required|string'
        ]);

        //Check the email
        $user = User::where('email', $fields['email'])->first();
        //Check the password
        if(!$user || !Hash::check($fields['password'], $user->password)){
            return response(['message' => 'Failed to login'], 401);
        }
        
        $token = $user->createToken('apptoken')->plainTextToken;

        $response = [
            'user' => $user,
            'token' => $token
        ];

        return response($response, 201);
    }
    /**
     * Logout
     */
    public function logout(Request $request){
        auth()->user()->tokens()->delete();

        return response(['message' => 'Logged out'], 201);
    }
}
