<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AuthController extends Controller
{
    private const ROLES = [
        'SUPER ADMIN',
        'ADMIN GATE 1',
        'ADMIN GATE 2',
        'ADMIN GATE 3',
        'USER',
    ];

    public function showLogin(Request $request): View|RedirectResponse
    {
        if ($request->session()->has('sigma_auth')) {
            return redirect()->route('dashboard');
        }

        return view('login', [
            'roles' => self::ROLES,
        ]);
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'operator' => ['required', 'string', 'max:80'],
            'role' => ['required', 'in:' . implode(',', self::ROLES)],
        ], [
            'operator.required' => 'ID Operator wajib diisi.',
            'role.required' => 'Role wajib dipilih.',
            'role.in' => 'Role yang dipilih tidak valid.',
        ]);

        $request->session()->regenerate();
        $request->session()->put('sigma_auth', [
            'operator' => trim($credentials['operator']),
            'role' => $credentials['role'],
        ]);

        if ($request->expectsJson()) {
            return response()->json([
                'success' => true,
                'redirect' => route('dashboard'),
            ]);
        }

        return redirect()->intended(route('dashboard'));
    }

    public function logout(Request $request): RedirectResponse
    {
        $request->session()->forget('sigma_auth');
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
