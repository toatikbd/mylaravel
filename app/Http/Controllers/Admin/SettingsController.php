<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\User;
use Brian2694\Toastr\Facades\Toastr;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Auth;

class SettingsController extends Controller
{
    public function index()
    {
        return view('admin.settings');
    }

    public function updateProfile(Request $request)
    {
       $this->validate($request,[
            'name' => 'required',
            'email' => 'required|email',
            'image' => 'required|image',
       ]);

       $image = $request->file('image');
       $slug = Str::slug('$request->name');
       $user = User::findOrFail(Auth::id());

        if (isset($image)) 
        {
            $currentDate = Carbon::now()->toDateString();
            $imageName = $slug . '-' . $currentDate . '-' . uniqid() . '.' . $image->getClientOriginalExtension();
            // Check in user image disk exists
            if (!Storage::disk('public')->exists('profile')) {
                Storage::disk('public')->makeDirectory('profile');
            }
            // delete old user image
            if (Storage::disk('public')->exists('profile/' . $user->image)) {
                Storage::disk('public')->delete('profile/' . $user->image);
            }
            // Resize image for upload
            $profile = Image::make($image)->resize(500, 500)->stream();
            Storage::disk('public')->put('profile/' . $imageName, $profile);
        } else {
            $imageName = $user->image;
        }

        $user->name = $request->name;
        $user->email = $request->email;
        $user->image = $imageName;
        $user->about = $request->about;
        $user->save();
        Toastr::success('Profile Updated Successfully', 'Success');
        return redirect()->back();
    }

    
    public function updatePassword(Request $request)
    {
        $this->validate($request, [
            'old_password' => 'required',
            'password' => 'required|min:6|confirmed',
        ]);

        $hashedPassword = Auth::user()->password;
        if (Hash::check($request->old_password, $hashedPassword))
        {
            if (!Hash::check($request->password, $hashedPassword)) 
            {
                $user = User::find(Auth::id());
                $user->password = Hash::make($request->password);
                $user->save();
                Toastr::success('Password Successfully Changed');
                Auth::logout();
                return redirect()->back();
            } else {
                Toastr::error('New Password Cannot be The Same as Old Password', 'Error');
                return redirect()->back();
            }
        } else {
            Toastr::error('Old Password not Match', 'Error');
            return redirect()->back();
        }
        
    } 
}