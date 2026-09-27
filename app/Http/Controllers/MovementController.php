<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class MovementController extends Controller
{
    private function authViewData(Request $request): array
    {
        $auth = $request->session()->get('sigma_auth', []);
        $sub = match ($auth['role'] ?? '') {
            'ADMIN GATE 1'=>'Gate 1','ADMIN GATE 2'=>'Gate 2','ADMIN GATE 3'=>'Gate 3',
            'SUPER ADMIN'=>'All Gate','USER'=>'User Access',default=>'SIGMA Access',
        };
        return ['operator'=>$auth['operator'] ?? 'Operator','role'=>$auth['role'] ?? 'USER','roleSubLabel'=>$sub];
    }

    private function movements(): array
    {
        return [
            ['kr'=>'KR-00120','vehicle'=>'B 7788 DD','direction'=>'JETTY','gate_pass'=>'MGP-021 (Gate 4)','activity'=>'Moving Material','time'=>'07:42','access'=>'ALLOWED'],
            ['kr'=>'KR-00119','vehicle'=>'B 4432 HH','direction'=>'JETTY','gate_pass'=>'—','activity'=>'KR Reguler','time'=>'07:30','access'=>'BLOCKED'],
            ['kr'=>'KR-00111','vehicle'=>'B 4521 ZZ','direction'=>'KP','gate_pass'=>'MGP-014 (Gate 4)','activity'=>'Ngepok Jetty','time'=>'07:10','access'=>'ALLOWED'],
        ];
    }

    public function index(Request $request): View|RedirectResponse
    {
        if (! $request->session()->has('sigma_auth')) return redirect()->route('login');
        $search=trim((string)$request->query('search',''));
        $direction=(string)$request->query('direction','');
        $items=collect($this->movements());
        if($search!=='') { $n=mb_strtolower($search); $items=$items->filter(fn($x)=>str_contains(mb_strtolower(implode(' ',$x)),$n)); }
        if(in_array($direction,['JETTY','KP'],true)) $items=$items->where('direction',$direction); else $direction='';
        return view('movement', array_merge($this->authViewData($request),[
            'movements'=>$items->values()->all(), 'filters'=>compact('search','direction')
        ]));
    }
}
