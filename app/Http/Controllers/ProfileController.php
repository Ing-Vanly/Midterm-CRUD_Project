<?php

namespace App\Http\Controllers;

use id;
use Exception;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Helpers\ImageManager;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
{

     public function index()
    {
        $user = Auth::user();  // Get the currently logged-in user
        return view('admin.backends.profile.index', compact('user'));
    }

    // Update the profile information (update method)
    public function update(Request $request)
    {
        // Get the currently logged-in user
        $user = Auth::user();

        // Validate the input data
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'phone' => 'nullable|string|max:20',
            'password' => 'nullable|string|min:6|confirmed',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:1024',
            'address' => 'nullable|string|max:255',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput()
                ->with(['success' => 0, 'msg' => 'Invalid form input']);
        }

        try {
            DB::beginTransaction();

            // Update the user's information
            $user->name = $request->name;
            $user->email = $request->email;
            $user->phone = $request->phone;
            $user->address = $request->address;

            // Update the password if provided
            if ($request->filled('password')) {
                $user->password = Hash::make($request->password);
            }

            // Handle image upload if it exists
            if ($request->hasFile('image')) {
                // Optionally delete the old image
                if ($user->image) {
                    ImageManager::delete('uploads/users/', $user->image);
                }

                // Save the new image
                $user->image = ImageManager::upload('uploads/users/', $request->image);
            }

            $user->save();

            DB::commit();

            // Redirect to the profile page with success message
            return redirect()->route('profile.index')->with(['success' => 1, 'msg' => 'Profile updated successfully']);
        } catch (Exception $e) {
            DB::rollBack();
            Log::error('Profile update error: ' . $e->getMessage());
            return redirect()->route('profile.index')->with(['success' => 0, 'msg' => 'Something went wrong']);
        }
    }
}
