<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        // Jika belum login, kembali ke halaman login.
        if (!$request->session()->get('sigma_logged_in')) {
            return redirect()->route('login');
        }

        // Ambil data dummy user dari session.
        $user = $request->session()->get('sigma_user');

        return view('dashboard', [
            'user' => $user,
        ]);
    }
}