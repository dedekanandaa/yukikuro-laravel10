<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
        if ($request->username == 'admin' && $request->password == '1234') {
            session([
                'username' => 'admin'
            ]);
            return redirect('/dashboard');
        } else {
            if (session('counter') < 3) {
                $i = session('counter')+1;
                session(['counter' => $i]);
                
                return redirect('/dashboard/login')->withErrors([
                    'errors' => 'username atau password salah!',
                    'a' => 'counter ='. $i,
                ]);
            } else {
                return redirect('/');
            }
        }
    }

    public function logout() {

    }
}
