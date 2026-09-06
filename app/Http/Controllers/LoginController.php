<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginController extends Controller
{
    /**
     * Dummy account untuk prototype.
     */
    private const DUMMY_EMPLOYEE_ID = 'SIGMA001';
    private const DUMMY_PASSWORD = 'sigma123';

    /**
     * Menampilkan halaman login.
     */
    public function show()
    {
        // Jika sudah login, langsung ke dashboard.
        if (session('sigma_logged_in')) {
            return redirect()->route('dashboard');
        }

        return view('login');
    }

    /**
     * Memproses dummy login.
     */
    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'employee_id' => ['required', 'string'],
            'password' => ['required', 'string'],
        ]);

        // Cek dummy account.
        if (
            $credentials['employee_id'] === self::DUMMY_EMPLOYEE_ID &&
            $credentials['password'] === self::DUMMY_PASSWORD
        ) {
            // Regenerasi session setelah login.
            $request->session()->regenerate();

            // Simpan status login ke session.
            $request->session()->put('sigma_logged_in', true);

            // Simpan informasi user dummy untuk digunakan di dashboard.
            $request->session()->put('sigma_user', [
                'employee_id' => self::DUMMY_EMPLOYEE_ID,
                'name' => 'Administrator',
            ]);

            return redirect()->route('dashboard');
        }

        // Jika login gagal.
        return back()
            ->withErrors([
                'employee_id' => 'Employee ID atau password salah.',
            ])
            ->withInput($request->only('employee_id'));
    }

    /**
     * Logout.
     */
    public function logout(Request $request)
    {
        // Hapus seluruh session.
        $request->session()->invalidate();

        // Buat CSRF token baru.
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}