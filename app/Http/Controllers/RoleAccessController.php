<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class RoleAccessController extends Controller
{
    private const ACCESS_TYPES = ['Super Admin','Admin Gate 1','Admin Gate 2','Admin Gate 3','User'];

    private function baseUsers(): array
    {
        return [
            ['name'=>'Ahmad Pratama','identity'=>'ADM-001','role'=>'Super Admin','gate'=>'All Gate','status'=>'Active'],
            ['name'=>'Rizky Maulana','identity'=>'G1-001','role'=>'Admin Gate 1','gate'=>'Gate 1','status'=>'Active'],
            ['name'=>'Siti Rahma','identity'=>'G2-001','role'=>'Admin Gate 2','gate'=>'Gate 2','status'=>'Nonactive'],
            ['name'=>'Dimas Saputra','identity'=>'G3-001','role'=>'Admin Gate 3','gate'=>'Gate 3','status'=>'Active'],
            ['name'=>'Budi Santoso','identity'=>'USR-001','role'=>'User','gate'=>'Gate 1','status'=>'Active'],
            ['name'=>'Nadia Putri','identity'=>'USR-002','role'=>'User','gate'=>'Gate 2','status'=>'Nonactive'],
        ];
    }

    private function users(Request $request): array
    {
        $users = array_merge($request->session()->get('sigma_role_access_users', []), $this->baseUsers());
        $updates = $request->session()->get('sigma_role_access_updates', []);
        $deleted = $request->session()->get('sigma_role_access_deleted', []);
        $users = array_values(array_filter($users, fn ($u) => ! in_array($u['identity'], $deleted, true)));
        return array_values(array_map(fn ($u) => $updates[$u['identity']] ?? $u, $users));
    }

    private function authViewData(Request $request): array
    {
        $auth = $request->session()->get('sigma_auth', []);
        $sub = match ($auth['role'] ?? '') {
            'ADMIN GATE 1'=>'Gate 1','ADMIN GATE 2'=>'Gate 2','ADMIN GATE 3'=>'Gate 3',
            'SUPER ADMIN'=>'All Gate','USER'=>'User Access',default=>'SIGMA Access',
        };
        return ['operator'=>$auth['operator'] ?? 'Operator','role'=>$auth['role'] ?? 'USER','roleSubLabel'=>$sub];
    }

    public function index(Request $request): View|RedirectResponse
    {
        if (! $request->session()->has('sigma_auth')) return redirect()->route('login');
        $search=trim((string)$request->query('search','')); $status=(string)$request->query('status',''); $role=(string)$request->query('role','');
        $users=collect($this->users($request)); $totalUsers=$users->count();
        if($search!==''){ $needle=mb_strtolower($search); $users=$users->filter(fn($u)=>str_contains(mb_strtolower(implode(' ',$u)),$needle)); }
        if(in_array($status,['Active','Nonactive'],true)) $users=$users->where('status',$status); else $status='';
        if(in_array($role,self::ACCESS_TYPES,true)) $users=$users->where('role',$role); else $role='';
        return view('role-access', array_merge($this->authViewData($request),[
            'users'=>$users->values()->all(),'totalUsers'=>$totalUsers,'accessTypes'=>self::ACCESS_TYPES,'filters'=>compact('search','status','role')
        ]));
    }

    public function create(Request $request): View|RedirectResponse
    {
        if (! $request->session()->has('sigma_auth')) return redirect()->route('login');
        return view('role-access-create', array_merge($this->authViewData($request),['accessTypes'=>self::ACCESS_TYPES]));
    }

    public function store(Request $request): RedirectResponse
    {
        if (! $request->session()->has('sigma_auth')) return redirect()->route('login');
        $data=$this->validateData($request);
        if(collect($this->users($request))->contains('identity',$data['identity'])) return back()->withErrors(['identity'=>'Identitas sudah digunakan.'])->withInput();
        $items=$request->session()->get('sigma_role_access_users',[]); array_unshift($items,$data); $request->session()->put('sigma_role_access_users',$items);
        return redirect()->route('role-access.index')->with('success','Data Role/Access berhasil ditambahkan.');
    }

    public function edit(Request $request, string $identity): View|RedirectResponse
    {
        if (! $request->session()->has('sigma_auth')) return redirect()->route('login');
        $user=collect($this->users($request))->firstWhere('identity',$identity);
        abort_if(! $user,404,'Data Role/Access tidak ditemukan.');
        return view('role-access-edit', array_merge($this->authViewData($request),['accessTypes'=>self::ACCESS_TYPES,'user'=>$user]));
    }

    public function update(Request $request, string $identity): RedirectResponse
    {
        if (! $request->session()->has('sigma_auth')) return redirect()->route('login');
        $existing=collect($this->users($request))->firstWhere('identity',$identity); abort_if(! $existing,404,'Data Role/Access tidak ditemukan.');
        $data=$this->validateData($request, false);
        $data['status'] = $existing['status'];
        if($data['identity']!==$identity && collect($this->users($request))->contains('identity',$data['identity'])) return back()->withErrors(['identity'=>'Identitas sudah digunakan.'])->withInput();
        $updates=$request->session()->get('sigma_role_access_updates',[]); $updates[$identity]=$data; $request->session()->put('sigma_role_access_updates',$updates);
        return redirect()->route('role-access.index')->with('success','Data Role/Access berhasil diubah.');
    }

    public function updateStatus(Request $request, string $identity): RedirectResponse
    {
        if (! $request->session()->has('sigma_auth')) return redirect()->route('login');
        $existing = collect($this->users($request))->firstWhere('identity', $identity);
        abort_if(! $existing, 404, 'Data Role/Access tidak ditemukan.');

        $validated = $request->validate(['status' => ['required', 'in:Active,Nonactive']]);
        $existing['status'] = $validated['status'];
        $updates = $request->session()->get('sigma_role_access_updates', []);
        $updates[$identity] = $existing;
        $request->session()->put('sigma_role_access_updates', $updates);

        return back()->with('success', 'Status Role/Access berhasil diubah menjadi '.$validated['status'].'.');
    }

    public function destroy(Request $request, string $identity): RedirectResponse
    {
        if (! $request->session()->has('sigma_auth')) return redirect()->route('login');
        $existing = collect($this->users($request))->firstWhere('identity', $identity);
        abort_if(! $existing, 404, 'Data tidak ditemukan.');
        $items = array_values(array_filter($request->session()->get('sigma_role_access_users', []), fn ($u) => $u['identity'] !== $identity));
        $request->session()->put('sigma_role_access_users', $items);
        $updates = $request->session()->get('sigma_role_access_updates', []); unset($updates[$identity]); $request->session()->put('sigma_role_access_updates', $updates);
        $deleted = $request->session()->get('sigma_role_access_deleted', []); if (! in_array($identity, $deleted, true)) $deleted[] = $identity; $request->session()->put('sigma_role_access_deleted', $deleted);
        return redirect()->route('role-access.index')->with('success', 'Data Role/Access berhasil dihapus.');
    }

    private function validateData(Request $request, bool $withStatus = true): array
    {
        $rules = [
            'name'=>['required','string','max:100'],
            'identity'=>['required','string','max:30'],
            'role'=>['required','in:'.implode(',',self::ACCESS_TYPES)],
            'gate'=>['required','in:All Gate,Gate 1,Gate 2,Gate 3'],
        ];
        if ($withStatus) $rules['status'] = ['required','in:Active,Nonactive'];
        return $request->validate($rules);
    }
}
