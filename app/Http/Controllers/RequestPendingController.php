<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class RequestPendingController extends Controller
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

    private function rows(): array
    {
        return [
            ['request'=>'REQ-260912-01','source'=>'Input User','date'=>'12 Sep 2026','date_value'=>'2026-09-12','type'=>'Import','kr'=>'KR-00126','vehicle'=>'B 9876 YY','driver'=>'Siti','total'=>2,'status'=>'PENDING','sender'=>'Siti','action'=>'Validasi'],
            ['request'=>'REQ-260912-02','source'=>'Upload Excel','date'=>'12 Sep 2026','date_value'=>'2026-09-12','type'=>'Export','kr'=>'KR-00127','vehicle'=>'B 6655 CC','driver'=>'Roni','total'=>4,'status'=>'PENDING','sender'=>'Admin Gate 1','action'=>'Proses'],
        ];
    }

    public function index(Request $request): View|RedirectResponse
    {
        if (! $request->session()->has('sigma_auth')) return redirect()->route('login');
        $date=(string)$request->query('date','2026-09-12');
        $type=(string)$request->query('type','');
        $source=(string)$request->query('source','');
        $status=(string)$request->query('status','');
        $search=trim((string)$request->query('search',''));
        $rows=collect($this->rows());
        if($date!=='') $rows=$rows->where('date_value',$date);
        if(in_array($type,['Import','Export'],true)) $rows=$rows->where('type',$type); else $type='';
        if(in_array($source,['Input User','Upload Excel'],true)) $rows=$rows->where('source',$source); else $source='';
        if(in_array($status,['PENDING','APPROVED','REJECTED'],true)) $rows=$rows->where('status',$status); else $status='';
        if($search!=='') { $n=mb_strtolower($search); $rows=$rows->filter(fn($r)=>str_contains(mb_strtolower(implode(' ',$r)),$n)); }
        return view('request-pending', array_merge($this->authViewData($request), ['requests'=>$rows->values()->all(),'filters'=>compact('date','type','source','status','search')]));
    }
}
