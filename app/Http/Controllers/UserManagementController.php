<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class UserManagementController extends Controller
{
    private const ROLES = ['Driver', 'User'];
    private const GATES = ['All Gate', 'Gate 1', 'Gate 2', 'Gate 3'];

    private function baseUsers(): array
    {
        return [
            ['name'=>'Ahmad','identity'=>'DRV-001','role'=>'Driver','gate'=>'Gate 2','status'=>'Active'],
            ['name'=>'Dani','identity'=>'DRV-002','role'=>'Driver','gate'=>'Gate 1','status'=>'Pending'],
            ['name'=>'Siti','identity'=>'USR-003','role'=>'User','gate'=>'Gate 1','status'=>'Active'],
            ['name'=>'Rizky','identity'=>'USR-004','role'=>'User','gate'=>'Gate 3','status'=>'Pending'],
        ];
    }

    private function users(Request $request): array
    {
        $users = array_merge($request->session()->get('sigma_user_management_users', []), $this->baseUsers());
        $updates = $request->session()->get('sigma_user_management_updates', []);
        $deleted = $request->session()->get('sigma_user_management_deleted', []);
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
        $all=collect($this->users($request)); $roles=$all->pluck('role')->merge(self::ROLES)->unique()->values()->all(); $totalUsers=$all->count(); $users=$all;
        if($search!==''){ $needle=mb_strtolower($search); $users=$users->filter(fn($u)=>str_contains(mb_strtolower(implode(' ',$u)),$needle)); }
        if(in_array($status,['Active','Pending'],true)) $users=$users->where('status',$status); else $status='';
        if($role!=='' && in_array($role,$roles,true)) $users=$users->where('role',$role); else $role='';
        return view('user-management', array_merge($this->authViewData($request), ['users'=>$users->values()->all(),'totalUsers'=>$totalUsers,'roles'=>$roles,'filters'=>compact('search','status','role')]));
    }

    public function create(Request $request): View|RedirectResponse
    {
        if (! $request->session()->has('sigma_auth')) return redirect()->route('login');
        return view('user-management-create', array_merge($this->authViewData($request), ['roles'=>self::ROLES,'gates'=>self::GATES]));
    }

    public function store(Request $request): RedirectResponse
    {
        if (! $request->session()->has('sigma_auth')) return redirect()->route('login');
        $data=$this->validateData($request);
        if(collect($this->users($request))->contains('identity',$data['identity'])) return back()->withErrors(['identity'=>'Identitas sudah digunakan.'])->withInput();
        $items=$request->session()->get('sigma_user_management_users',[]); array_unshift($items,$data); $request->session()->put('sigma_user_management_users',$items);
        return redirect()->route('user-management.index')->with('success','Data User berhasil ditambahkan.');
    }

    public function edit(Request $request, string $identity): View|RedirectResponse
    {
        if (! $request->session()->has('sigma_auth')) return redirect()->route('login');
        $user=collect($this->users($request))->firstWhere('identity',$identity); abort_if(! $user,404,'Data User tidak ditemukan.');
        return view('user-management-edit', array_merge($this->authViewData($request), ['roles'=>self::ROLES,'gates'=>self::GATES,'user'=>$user]));
    }

    public function update(Request $request, string $identity): RedirectResponse
    {
        if (! $request->session()->has('sigma_auth')) return redirect()->route('login');
        $existing=collect($this->users($request))->firstWhere('identity',$identity); abort_if(! $existing,404,'Data User tidak ditemukan.');
        $data=$this->validateData($request);
        if($data['identity']!==$identity && collect($this->users($request))->contains('identity',$data['identity'])) return back()->withErrors(['identity'=>'Identitas sudah digunakan.'])->withInput();
        $updates=$request->session()->get('sigma_user_management_updates',[]); $updates[$identity]=$data; $request->session()->put('sigma_user_management_updates',$updates);
        return redirect()->route('user-management.index')->with('success','Data User berhasil diubah.');
    }

    public function destroy(Request $request, string $identity): RedirectResponse
    {
        if (! $request->session()->has('sigma_auth')) return redirect()->route('login');
        $existing = collect($this->users($request))->firstWhere('identity', $identity);
        abort_if(! $existing, 404, 'Data tidak ditemukan.');

        $items = array_values(array_filter($request->session()->get('sigma_user_management_users', []), fn ($u) => $u['identity'] !== $identity));
        $request->session()->put('sigma_user_management_users', $items);

        $updates = $request->session()->get('sigma_user_management_updates', []);
        unset($updates[$identity]);
        $request->session()->put('sigma_user_management_updates', $updates);

        $deleted = $request->session()->get('sigma_user_management_deleted', []);
        if (! in_array($identity, $deleted, true)) $deleted[] = $identity;
        $request->session()->put('sigma_user_management_deleted', $deleted);

        return redirect()->route('user-management.index')->with('success', 'Data User berhasil dihapus.');
    }

    private function validateData(Request $request): array
    {
        return $request->validate([
            'name'=>['required','string','max:100'], 'identity'=>['required','string','max:30'],
            'role'=>['required','in:'.implode(',',self::ROLES)], 'gate'=>['required','in:'.implode(',',self::GATES)], 'status'=>['required','in:Active,Pending'],
        ]);
    }
}
