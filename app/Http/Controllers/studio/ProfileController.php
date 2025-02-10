<?php

namespace App\Http\Controllers\studio;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\NateRasul;
use App\Models\LyricistModel;
use App\Models\VideoLink;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class ProfileController extends Controller
{
   public function profile(){
    return view('pages.studio.profile');
   }

   public function edit_profile(){
      return view('pages.studio.edit_profile');
   }

   public function update_profile(Request $request)
{
    // Validation Rules
    $rules = [
        'whatsapp'  => 'nullable|numeric',
        'twitter'   => 'nullable|string',
        'instagram' => 'nullable|string',
        'facebook'  => 'nullable|string',
        'about'  => 'nullable|string',
        'phone'     => 'nullable|numeric',
        'email'     => 'nullable|email',
        'profile'   => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        'cover'     => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
    ];

    $lyricist = Auth::guard('studio')->user();

    // Check if email is being updated and already exists
    if ($lyricist->email != $request->email) {
        if (LyricistModel::where('email', $request->email)->exists()) {
            return back()->with('error', 'Oops! Email is already in use.');
        }
    }

    // Check if phone is being updated and already exists
    if ($lyricist->phone != $request->phone) {
        if (LyricistModel::where('phone', $request->phone)->exists()) {
            return back()->with('error', 'Oops! Phone number is already in use.');
        }
    }

    // Validate Request
    $validatedData = $request->validate($rules);
// dd($lyricist->cover);
    // Handle Profile Image Upload
    if ($request->hasFile('profile')) {
        $image =$request->file('profile');
        $imagePath = $image->getPathname();
        $imageName = $image->getClientOriginalName();
        $externalServerUrl = "$this->ImgUrl/update.php";
        $response = Http::attach(
            'image', 
            file_get_contents($imagePath),$imagePath,
            ['Content-Type' => $image->getClientOriginalExtension()]
            )->post($externalServerUrl,['old_path' => $lyricist->profile]);
            if ($response->successful()) {     
                $validatedData['profile'] = $response;       
            }     
      
    }

    // return $response;

    // Handle Cover Image Upload
    if ($request->hasFile('cover')) {
        $image =$request->file('cover');
        $imagePath = $image->getPathname();
        $imageName = $image->getClientOriginalName();
        $externalServerUrl = "$this->ImgUrl/update.php";
        $response = Http::attach(
            'image', 
            file_get_contents($imagePath),$imagePath,
            ['Content-Type' => $image->getClientOriginalExtension()]
            )->post($externalServerUrl,['old_path' => $lyricist->cover]);
            if ($response->successful()) {     
                $validatedData['cover'] = $response;       
            }   
        
    }

   
    // Update Lyricist Profile
     $lyricist->update($validatedData);

    return redirect()->route('studio.profile')->with('success', 'Profile updated successfully!');
}

}

