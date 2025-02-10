<?php

namespace App\Http\Controllers\studio;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\LyricistModel;
use Illuminate\Support\Facades\Auth;

class studioAuthController extends Controller
{
   public function login(){
    if (!Auth::guard('studio')->check()) {
      return view('pages.studio.login');
    }
    return back();
   }

   public function login_studio(Request $request){

    $credentials = $request->only('email', 'password');
    $remember = $request->has('remember');

    if (Auth::guard('studio')->attempt($credentials, $remember)) {
        return redirect()->intended(route('studio.dashboard'));
     
    }

    return back()->withErrors(['email' => 'Invalid credentials.']);
   }

   public function signup(){
    if (!Auth::guard('studio')->check()) {
    return view('pages.studio.signup');
    }
    return back();
   }


   public function signup_studio(Request $request){
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users',
        'phone' => 'required|string|max:15|min:11',
        'password' => 'required|string|min:8|confirmed', // Confirmed rule
    ]);

    // Create the user
    $user = LyricistModel::create([
        'name' => $request->name,
        'email' => $request->email,
        'phone' => $request->phone,
        'password' => Hash::make($request->password),
        'terms' => 'accepted'
    ]);

    return redirect()->route('studio.login')->with('success', 'Account created successfully!');
   }

   public function logout()
    {
        Auth::guard('studio')->logout();
        return redirect()->route('studio.login');
    }
}
