<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class RegistrationController extends Controller
{
    private function authViewData(Request $request): array
    {
        $auth = $request->session()->get('sigma_auth', []);
        $sub = match ($auth['role'] ?? '') {
            'ADMIN GATE 1' => 'Gate 1', 'ADMIN GATE 2' => 'Gate 2', 'ADMIN GATE 3' => 'Gate 3',
            'SUPER ADMIN' => 'All Gate', 'USER' => 'User Access', default => 'SIGMA Access',
        };
        return ['operator'=>$auth['operator'] ?? 'Operator','role'=>$auth['role'] ?? 'USER','roleSubLabel'=>$sub];
    }

    public function create(Request $request): View|RedirectResponse
    {
        if (! $request->session()->has('sigma_auth')) return redirect()->route('login');
        return view('registration', array_merge($this->authViewData($request), [
            'categories' => ['REGULER','MOVING','KR OPERASIONAL / KARYAWAN'],
            'vehicleTypes' => ['Pickup','Pickup Box','Truck Engkel','Truck Double','Dumptruck','Truck Tangki','Mobil Roda 4 Pribadi'],
            'goodsTypes' => ['Product','Nonproduct','Raw Material','MRO','ByProduct'],
            'units' => ['Ton','Kg','Unit'],
            'pendingRequests' => $request->session()->get('sigma_registration_master_requests', []),
            'pendingCount' => count($request->session()->get('sigma_registration_master_requests', [])),
        ]));
    }

    public function storeMasterRequest(Request $request): RedirectResponse
    {
        if (! $request->session()->has('sigma_auth')) return redirect()->route('login');

        $data = $request->validate([
            'master_type' => ['required', 'in:company,vehicle,vehicle_type,driver,goods_type,origin,destination'],
            'master_value' => ['required', 'string', 'max:120'],
        ]);

        $labels = [
            'company' => 'Perusahaan', 'vehicle' => 'Kendaraan', 'vehicle_type' => 'Jenis Kendaraan',
            'driver' => 'Driver', 'goods_type' => 'Jenis Barang', 'origin' => 'Asal', 'destination' => 'Tujuan',
        ];
        $auth = $request->session()->get('sigma_auth', []);
        $items = $request->session()->get('sigma_registration_master_requests', []);
        array_unshift($items, [
            'request_no' => 'REQ-'.now()->format('YmdHis'),
            'type' => $data['master_type'],
            'type_label' => $labels[$data['master_type']],
            'value' => trim($data['master_value']),
            'requester' => $auth['operator'] ?? 'Operator',
            'date' => now()->format('d/m/Y H:i'),
            'status' => 'Pending',
        ]);
        $request->session()->put('sigma_registration_master_requests', $items);

        return redirect()->route('registration.create')->with('success', 'Data baru berhasil diajukan dan menunggu persetujuan Super Admin.');
    }

    public function store(Request $request): RedirectResponse
    {
        if (! $request->session()->has('sigma_auth')) return redirect()->route('login');
        $data = $request->validate([
            'category'=>['required','string','max:30'], 'company'=>['required','string','max:120'],
            'vehicle'=>['required','string','max:50'], 'vehicle_type'=>['required','string','max:50'],
            'driver'=>['required','string','max:100'], 'goods_type'=>['required','string','max:50'],
            'origin'=>['required','string','max:100'], 'destination'=>['required','string','max:100'],
            'item_name'=>['required','array','min:1'], 'item_name.*'=>['required','string','max:120'],
            'item_type'=>['required','array'], 'item_qty'=>['required','array'], 'item_unit'=>['required','array'],
            'item_note'=>['nullable','array'], 'submit_action'=>['required','in:draft,submit'],
        ]);
        $items=[];
        foreach ($data['item_name'] as $i=>$name) $items[]=[
            'name'=>$name,'type'=>$data['item_type'][$i] ?? 'Product','qty'=>$data['item_qty'][$i] ?? 1,
            'unit'=>$data['item_unit'][$i] ?? 'Ton','note'=>$data['item_note'][$i] ?? '',
        ];
        $record=[
            'request_no'=>'KR-'.now()->format('YmdHis'), 'category'=>$data['category'], 'company'=>$data['company'],
            'vehicle'=>$data['vehicle'], 'vehicle_type'=>$data['vehicle_type'], 'driver'=>$data['driver'],
            'goods_type'=>$data['goods_type'], 'origin'=>$data['origin'], 'destination'=>$data['destination'],
            'items'=>$items, 'status'=>$data['submit_action']==='draft' ? 'Draft' : 'Pending',
            'submitted_at'=>now()->format('Y-m-d H:i:s'),
        ];
        $key=$data['submit_action']==='draft' ? 'sigma_registration_drafts' : 'sigma_registration_pending';
        $records=$request->session()->get($key,[]); array_unshift($records,$record); $request->session()->put($key,$records);
        return redirect()->route('registration.create')->with('success', $data['submit_action']==='draft' ? 'Draft registrasi berhasil disimpan.' : 'Registrasi berhasil diajukan dan menunggu persetujuan.');
    }
}
