<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\NasheedView;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class userAuthController extends Controller
{
     public function register(Request $request) {
        // Validate request data

      
        $validator = \Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20|unique:users',
            'whatsapp' => 'nullable|string|max:20',
            'email' => 'required|email|unique:users',
            'password' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        // Create user
        $user = User::create([
            'name' =>$request->name,
            'phone' =>$request->phone,
            'whatsapp' =>$request->whatsapp,
            'email' =>$request->email,
            'password' =>Hash::make($request->password)
        ]);

        return response()->json([
            'message' => 'User registered successfully!',
            'user' => $user
        ], 200);
    }

     // Login method with Sanctum token generation
     public function login(Request $request) {
        // Validate the request data
        $validator = \Validator::make($request->all(), [
            'email_or_phone' => 'required|string',
            'password' => 'required|min:6'
        ]);
    
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
    
        // Check if the input is email or phone
        $user = null;
        if (filter_var($request->email_or_phone, FILTER_VALIDATE_EMAIL)) {
            // Check if email exists
            $user = User::where('email', $request->email_or_phone)->first();
        } else {
            // Check if phone number exists
            $user = User::where('phone', $request->email_or_phone)->first();
        }
    
        // If user not found or password doesn't match
        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json(['message' => 'Invalid credentials'], 401);
        }
    
        // Generate API token
        $token = $user->createToken('nasheedHub')->plainTextToken;
    
        return response()->json([
            'message' => 'Login successful!',
            'user'=>$user,
            'token' => $token
        ]);
    }
}
