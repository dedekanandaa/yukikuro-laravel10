<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

use function Laravel\Prompts\password;

class dashboard extends Controller
{
    public function index() {
        return view('dashboard.index');
    }

    public function login() {
        if (!empty(session('username'))) {
            return redirect('/dashboard');
        }
        if (session('counter') > 3) {
            return redirect('/');
        }
        return view('dashboard.login');
    }

    public function loginProcess(Request $request) {
        
        if ($request->username === 'admin' && Hash::check($request->password, '$2y$12$3wbkWXCKbOVqUZp48jXA1.3R6JvkQ18El6QcsxdrU3i11wN4rMNw2')) {
            $request->session()->put('user', 'admin');
            return redirect()->intended('/dashboard'); 
        } else {
            if (session('counter') < 3) {
                $i = session('counter')+1;
                session(['counter' => $i]);
                
                return redirect('/dashboard/login')->withErrors([
                    'errors' => 'username or password is wrong!',
                ]);
            } else {
                return redirect('/');
            }
        }
    }

    // public function loginProcess(Request $request)
    // {
    //     $credentials = $request->only('email', 'password');
    //     // Cek apakah user sudah terautentikasi dan cek apakah user sudah terverifikasi
    //     if (Auth::attempt($credentials)) {
    //         // Jika autentikasi berhasil
    //         $user = Auth::user();
    //         $request->session()->regenerate();
    //         // Buat session untuk user
    //         $request->session()->put('user', $user);
    //         return redirect()->intended('/'); // Redirect ke halaman dashboard atau halaman setelah login berhasil
    //     }
    //     // Jika autentikasi gagal, kembalikan ke halaman login dengan pesan error
    //     return redirect('/login')->withErrors([
    //         'email' => 'Email or password is wrong.',
    //     ]);
    // }

    public function logout(Request $request)
    {
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
