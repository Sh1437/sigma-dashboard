<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(Request $request): View|RedirectResponse
    {
        $auth = $request->session()->get('sigma_auth');

        if (!$auth) {
            return redirect()->route('login');
        }

        $gateMap = [
            'ADMIN GATE 1' => 'Gate 1',
            'ADMIN GATE 2' => 'Gate 2',
            'ADMIN GATE 3' => 'Gate 3',
            'SUPER ADMIN' => 'All Gate',
            'USER' => 'User Access',
        ];

        $now = Carbon::now('Asia/Jakarta')->locale('id');

        return view('dashboard', [
            'operator' => $auth['operator'],
            'role' => $auth['role'],
            'roleSubLabel' => $gateMap[$auth['role']] ?? 'SIGMA',
            'dateLabel' => ucfirst($now->translatedFormat('l, d F Y')) . ' · ' . $now->format('H:i') . ' WIB',
        ]);
    }
}
