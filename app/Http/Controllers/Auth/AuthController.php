<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class AuthController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            Alert::error('Gagal', 'Login gagal, silakan cek kembali data yang Anda masukkan.');
            return back()->withErrors($validator)->withInput();
        }

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            Alert::success('Hore!', 'Login berhasil');
            if(Auth::user()->role_type==0){
                Alert::success('Hore!', 'Login berhasil');
                // return redirect()->route('home.admin');
            }
            else if(Auth::user()->role_type==1){
                Alert::success('Hore!', 'Login berhasil');
                return redirect()->route('admin.dashboard.index');
            }
            else if(Auth::user()->role_type==2){
                Alert::success('Hore!', 'Login berhasil');
                return redirect()->route('admin.dashboard.index');
            }
            return redirect()->route('login.index');
        }

        Alert::error('Gagal', 'Email atau password salah.');
        return back()->withErrors([
            'email' => 'Email atau password salah.',
        ])->withInput();
    }

    public function logout()
    {
        Auth::logout();
        Alert::success('Berhasil Logout');
        return redirect()->route('login.index');
    }
}
