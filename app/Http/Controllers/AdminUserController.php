<?php

namespace App\Http\Controllers;

use App\Models\AdminUser;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminUserController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }

    public function getLogin()
    {
        if (Auth::guard('admin')->check()) {
            return redirect()->route('admin.dashboard');
        } else {
            return view('admin.auth.login');
        }
    }

    public function postLogin(Request $request)
    {

        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);
        if (Auth::guard('admin')->attempt(['email' => $request->email, 'password' =>   $request->password])) {
            return redirect()->route('admin.dashboard')->with('success', 'You are Logged in sucessfully.');
        } else {
            return redirect()->back()->with('error', 'Whooops Email and Password does not match.');
        }
    }

    public function adminLogout()
    {
        Auth::guard('admin')->logout();
        return redirect()->route('admin.login');
    }

    //Admin Auth Methods End
    
    public function dashboard()
    {
        
       return view('admin.dashboard');
    }

    public function getAllUsers()
    {
        $users = User::all();
        return view('admin.users-list',compact('users'));
    }

    public function updateUserStatus(Request $request)
    {

        $user = User::find($request->id);
        User::where('id', $user->id)->update([
            'status' => !$user->status
        ]);
        return redirect()->back()->with('success', 'Update Status Successfully');
    }


    public function getAllAdminUsers()
    {
        $adminUsers = AdminUser::all();
        // $adminUsers = AdminUser::where('role','!=','super_admin')->get();
        return view('admin.admin-users-list',compact('adminUsers'));
    }

    public function updateAdminUserStatus(Request $request)
    {

        $user = AdminUser::find($request->id);
        AdminUser::where('id', $user->id)->update([
            'status' => !$user->status
        ]);
        return redirect()->back()->with('success', 'Update Status Successfully');
    }

    public function createAdminUser(){
        return view('admin.admin-user-form');
    }

    public function storeAdminUser(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:admin_users',
            'password' => 'required',
        ]);

        $data = $request->all();
       return $this->store($data);


    }

    public function store(array $data)
    {
        AdminUser::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'created_at' => now(),
            'updated_at' => now()
        ]);
        return redirect()->route('admin-users-list')->with('success', 'Admin user Created sucessfully.');
    }

   
}
