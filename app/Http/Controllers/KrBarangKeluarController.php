<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class KrBarangKeluarController extends Controller
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

    private function transactions(): array
    {
        return [
            ['kr'=>'KR-00125','date'=>'12 Sep 2026','vehicle'=>'B 1234 XX','driver'=>'Ahmad','goods'=>'Import · Coil Steel','direction'=>'MASUK','gate_in'=>'Gate 2','time_in'=>'08:12','gate_out'=>'—','time_out'=>'—','status'=>'INSIDE'],
            ['kr'=>'KR-00126','date'=>'12 Sep 2026','vehicle'=>'B 9876 YY','driver'=>'Siti','goods'=>'Export · Scrap Besi','direction'=>'MASUK','gate_in'=>'Gate 1','time_in'=>'07:45','gate_out'=>'—','time_out'=>'—','status'=>'PENDING'],
            ['kr'=>'KR-00118','date'=>'12 Sep 2026','vehicle'=>'B 6688 AA','driver'=>'Budi','goods'=>'Material Internal','direction'=>'KELUAR','gate_in'=>'Gate 2','time_in'=>'06:30','gate_out'=>'Gate 2','time_out'=>'10:02','status'=>'COMPLETED'],
            ['kr'=>'KR-00117','date'=>'11 Sep 2026','vehicle'=>'B 4412 CD','driver'=>'Rizky','goods'=>'Import · Raw Material','direction'=>'MASUK','gate_in'=>'Gate 3','time_in'=>'13:10','gate_out'=>'—','time_out'=>'—','status'=>'INSIDE'],
            ['kr'=>'KR-00116','date'=>'11 Sep 2026','vehicle'=>'B 7621 EF','driver'=>'Dani','goods'=>'Export · Product','direction'=>'KELUAR','gate_in'=>'Gate 1','time_in'=>'09:02','gate_out'=>'Gate 1','time_out'=>'15:21','status'=>'COMPLETED'],
            ['kr'=>'KR-00115','date'=>'11 Sep 2026','vehicle'=>'B 3198 GH','driver'=>'Nadia','goods'=>'MRO','direction'=>'MASUK','gate_in'=>'Gate 2','time_in'=>'10:33','gate_out'=>'—','time_out'=>'—','status'=>'PENDING'],
        ];
    }

    public function index(Request $request): View|RedirectResponse
    {
        if (! $request->session()->has('sigma_auth')) return redirect()->route('login');
        $search=trim((string)$request->query('search',''));
        $gate=(string)$request->query('gate','');
        $status=(string)$request->query('status','');
        $page=max(1,(int)$request->query('page',1));
        $items=collect($this->transactions());
        if($search!=='') { $n=mb_strtolower($search); $items=$items->filter(fn($x)=>str_contains(mb_strtolower(implode(' ',$x)),$n)); }
        if(in_array($gate,['Gate 1','Gate 2','Gate 3'],true)) $items=$items->filter(fn($x)=>$x['gate_in']===$gate || $x['gate_out']===$gate); else $gate='';
        if(in_array($status,['INSIDE','PENDING','COMPLETED'],true)) $items=$items->where('status',$status); else $status='';
        $total=$items->count(); $perPage=3; $pages=max(1,(int)ceil($total/$perPage)); $page=min($page,$pages);
        $shown=$items->values()->slice(($page-1)*$perPage,$perPage)->values()->all();
        return view('kr-barang-keluar', array_merge($this->authViewData($request),[
            'transactions'=>$shown,'total'=>$total,'page'=>$page,'pages'=>$pages,'perPage'=>$perPage,
            'filters'=>compact('search','gate','status')
        ]));
    }
}
