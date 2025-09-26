<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    //    public function index(Request $request)
    // {
    //     $query = User::query();

    //     if ($request->filled('name')) {
    //         $query->where('name', 'like', '%' . $request->name . '%');
    //     }

    //     if ($request->filled('gender')) {
    //         $query->where('gender', $request->gender);
    //     }

    //     if ($request->filled('status')) {
    //         // Note: in your DB, status might be 0/1 but your filter sends 'active'/'inactive'.
    //         // So map status filter accordingly:
    //         if ($request->status == 'active') {
    //             $query->where('status', 1);
    //         } elseif ($request->status == 'inactive') {
    //             $query->where('status', 0);
    //         }
    //     }

    //     $users = $query->latest()->paginate(10)->withQueryString();

    //     return view('admin.backends.user.index', compact('users'));
    // }

    public function index(Request $request)
    {
        $query = User::query();

        if ($request->filled('name')) {
            $query->where('name', 'like', '%' . $request->name . '%');
        }

        if ($request->filled('gender')) {
            $query->where('gender', $request->gender);
        }

        if ($request->filled('status')) {
            if ($request->status == 'active') {
                $query->where('status', 1);
            } elseif ($request->status == 'inactive') {
                $query->where('status', 0);
            }
        }

        $users = $query->latest()->paginate(10)->withQueryString();

        return view('admin.backends.user.index', compact('users'));
    }

    public function create()
    {
        $roles = Role::all();
        return view('admin.backends.user.create', compact('roles'));
    }
    public function store(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'name'       => 'required|string|max:255',
            'email'      => 'required|email|unique:users,email',
            'password'   => 'required|confirmed|min:6',
            'status'     => 'required|in:0,1',
            'address'    => 'nullable|string',
            'role_id'    => 'required|exists:roles,id',
            'image'      => 'nullable',
        ]);

        try {
            DB::beginTransaction();

            $user = new User();
            $user->name     = $request->name;
            $user->email    = $request->email;
            $user->password = Hash::make($request->password);
            $user->gender   = $request->gender;
            $user->age      = $request->age;
            $user->phone    = $request->phone;
            $user->status   = $request->status;
            $user->address  = $request->address;

            if ($request->hasFile('image')) {
                $imageName = time() . '.' . $request->image->extension();
                $request->image->move(public_path('uploads/users'), $imageName);
                $user->image = $imageName;
            }

            $user->save();

            $role = Role::findOrFail($request->role_id);
            $user->assignRole($role->name);

            DB::commit();

            return redirect()->route('user.index')->with([
                'success' => true,
                'msg' => __('Created Successfully!')
            ]);
        } catch (\Exception $e) {
            DB::rollBack();

            // Log the error and return a user-friendly message
            Log::error('User creation failed: ' . $e->getMessage());
            return redirect()->back()->with([
                'success' => false,
                'msg' => __('Something went wrong: ') . $e->getMessage()
            ]);
        }
    }

    public function show(string $id)
    {
        $user = User::findOrFail($id);
        $roles = Role::all();
        return view('admin.backends.user.show', compact('user', 'roles'));
    }

    public function edit(string $id)
    {
        $user = User::findOrFail($id);
        $roles = Role::all();
        return view('admin.backends.user.edit', compact('user', 'roles'));
    }

    public function update(Request $request, string $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'name'       => 'required|string|max:255',
            'email'      => 'required|email|unique:users,email,' . $user->id,
            'password'   => 'nullable|confirmed|min:6',
            'gender'     => 'nullable|in:male,female,other',
            'age'        => 'nullable|integer',
            'phone'      => 'nullable|string|max:20',
            'status'     => 'required',
            'address'    => 'nullable|string',
            'role_id'   => 'required|exists:roles,id',
            'image'      => 'nullable',
        ]);

        try {
            DB::beginTransaction();

            $user->name    = $request->name;
            $user->email   = $request->email;
            $user->gender  = $request->gender;
            $user->age     = $request->age;
            $user->phone   = $request->phone;
            $user->status  = $request->status;
            $user->address = $request->address;
            $user->role_id = $request->role_id;

            if ($request->filled('password')) {
                $user->password = Hash::make($request->password);
            }

            if ($request->hasFile('image')) {
                if ($user->image && file_exists(public_path('uploads/users/' . $user->image))) {
                    unlink(public_path('uploads/users/' . $user->image));
                }

                $imageName = time() . '.' . $request->image->extension();
                $request->image->move(public_path('uploads/users'), $imageName);
                $user->image = $imageName;
            }

            $user->save();

            $role = Role::findOrFail($request->role_id);
            $user->syncRoles([$role->name]);

            DB::commit();

            return redirect()->route('user.index')->with([
                'success' => true,
                'msg' => __('Updated Successfully!')
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withInput()->with([
                'success' => false,
                'msg' => __('Something went wrong! ') . $e->getMessage()
            ]);
        }
    }

    public function destroy($id)
    {
        try {
            DB::beginTransaction();

            $user = User::findOrFail($id);
            if ($user->image && file_exists(public_path('uploads/users/' . $user->image))) {
                unlink(public_path('uploads/users/' . $user->image));
            }

            $user->delete();

            DB::commit();

            return response()->json([
                'status' => 1,
                'msg' => __('User deleted successfully.')
            ]);
        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json([
                'status' => 0,
                'msg' => __('Something went wrong!')
            ]);
        }
    }
    public function updateStatus(Request $request)
    {
        try {
            DB::beginTransaction();
            $user = User::findOrFail($request->id);
            $user->status = $user->status === 1 ? 0 : 1;
            $user->save();
            DB::commit();

            $output = ['status' => 1, 'msg' => __('Status Updated!')];
        } catch (Exception $e) {
            DB::rollBack();
            $output = ['status' => 0, 'msg' => __('Something went wrong!')];
        }
        return response()->json($output);
    }
}
