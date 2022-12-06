<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{

    // User Auth Method Start ....
    public function index()
    {
        if (Auth::check()) {

            return redirect('dashboard');
        }
        return view('auth.login');
    }

    public function customLogin(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            if (Auth::user()->status != 0) {
                return redirect('dashboard');
            } else {
                return redirect("login")->with('error', 'Plz contact admin to activate your account');
            }
        }

        return redirect("login")->with('error', 'Login details are not valid');
    }

    public function registration()
    {
        return view('auth.registration');
    }

    public function customRegistration(Request $request)
    {
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required',
        ]);

        $data = $request->all();
        $check = $this->create($data);

        return redirect("login")->with('success', 'User Create Successfully');
    }

    public function create(array $data)
    {
        return User::create([
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'email' => $data['email'],
            'phone' => $data['phone'],
            'password' => Hash::make($data['password'])
        ]);
    }


    public function dashboard()
    {
        if (Auth::user()) {
            if (Auth::user()->status !== 0) {

                return view('dashboard')->with('success', 'Successfully Login 😎');
            } else {
                Auth::logout();

                return redirect("login")->with('error', 'Plz contact admin to activate your account');
            }
        }

        return redirect("login")->with('error', 'You are not allowed to access');
    }
    public function welcome()
    {
        if (Auth::user()) {
            return view('dashboard');
        }

        return redirect("login")->with('success', 'please login to continue');
    }

    public function signOut()
    {

        Auth::logout();

        return Redirect('login');
    }

    // User Auth Method End.


}
