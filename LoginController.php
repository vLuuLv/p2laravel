<?php

namespace App\Http\Controllers;

use App\Models\Tamu;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function index()
    {
        return view('login', [
            "title" => "Login | Hotel.LuuL",
            "active" => "off"
        ]);
    }

    // Function tombol login
    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'username' => 'required',
            'password' => 'required'
        ], [
            'username.required' => 'Username tidak boleh kosong!',
            'password.required' => 'Password tidak boleh kosong!',
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->intended('home');
        }
        return back()->with('loginError', 'Login failed!');
    }

    public function home()
    {
        return view('home', [
            "title" => "Home | Hotel.LuuL"
        ]);
    }

    public function register()
    {
        return view('register', [
            "title" => "Register | Hotel.LuuL"
        ]);
    }

    // Function tombol daftar
    public function daftar(Request $request)
    {
        // dd($request->all());
        $validator = Validator::make($request->all(), [
            'nama' => 'required',
            'username' => 'required|unique:users',
            'password' => 'required',
            'email' => 'required|email',
            'no_telp' => 'required',
        ], [
            'nama.required' => 'nama tidak boleh kosong!',
            'username.required' => 'Username tidak boleh kosong!',
            'password.required' => 'Password tidak boleh kosong!',
            'email.required' => 'Email tidak boleh kosong!',
            'no_telp.required' => 'Nomor HP tidak boleh kosong!',
            'username.unique' => 'Username sudah terdaftar!',
        ]);

        if ($validator->fails()) {
            return back()->withErrors(['msg' => $validator->errors()->all()]);
        }

        if ($validator->passes()) {
            DB::transaction(function () use ($request) {

                $user = User::create([
                    'username' => $request->username,
                    'password' => Hash::make($request->password),
                    'role' => 'tamu',
                ]);

                Tamu::create([
                    'user_id' => $user->id,
                    'nama' => $request->nama,
                    'email' => $request->email,
                    'no_telp' => $request->no_telp,
                ]);
            });

            return redirect('/login')->with(['success' => 'Pendaftaran berhasil!']);
        }
    }

    // Function tombol logout
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
