<?php

namespace Modules\HakAkses\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;

class HakAksesController extends Controller
{
    public function index(){
      $permission = 5;
      $user = Auth::user();
      $ksp = $user->name;

      $rolepermission = DB::table('role_permissions')->join('roles', 'roles.id', '=', 'role_permissions.role_id')
          ->where('user_id', $user->id)
          ->where('permission_id', $permission)
          ->select('roles.name')
          ->first();

      $allowedRoles = ['Super Admin'];

      if ($ksp == 'Ketua Sp' || ($rolepermission && in_array($rolepermission->name, $allowedRoles))) {
          return view('hakakses::index',[
            'permission' => DB::table('permissions')->get(),
            'user' => User::where('name' ,'!=', 'Ketua Sp')->get()
        ]);
        }

        return redirect('/dashboard-admin');
      
    }


    public function ajax_data($id,Request $request){
      $permission = 5;
      $user = Auth::user(); 
      $ksp = $user->name;

      $rolepermission = DB::table('role_permissions')->join('roles', 'roles.id', '=', 'role_permissions.role_id')
          ->where('user_id', $user->id)
          ->where('permission_id', $permission)
          ->select('roles.name')
          ->first();

      $allowedRoles = ['Super Admin'];

      if ($ksp == 'Ketua Sp' || ($rolepermission && in_array($rolepermission->name, $allowedRoles))) {
          $user = User::where('id', Crypt::decrypt($id))->first();
          $permission = DB::table('role_permissions')->where('user_id', Crypt::decrypt($id))->get();
          return response()->json([$user,$permission]);
        }

        return response()->json(['error' => 'Anda Tidak Memiliki Akses']);
       
    }


    public function store(Request $request)
{

      $permission = 5;
      $user = Auth::user();
      $ksp = $user->name;

      $rolepermission = DB::table('role_permissions')->join('roles', 'roles.id', '=', 'role_permissions.role_id')
          ->where('user_id', $user->id)
          ->where('permission_id', $permission)
          ->select('roles.name')
          ->first();

      $allowedRoles = ['Super Admin'];

      if ($ksp == 'Ketua Sp' || ($rolepermission && in_array($rolepermission->name, $allowedRoles))) {
        $request->validate([
        'roles' => 'required|array',
    ], [
        'roles.required' => 'Semua role wajib diisi.',
    ]);

    $totalPermissions = DB::table('permissions')->count(); // hitung jumlah permission yang ada
    $filledRoles = count($request->roles);   // hitung berapa yang diisi user

    if ($filledRoles < $totalPermissions) {
        return response()->json([
            'errors' => 'Semua permission harus dipilih salah satu rolenya.'
        ], 422);
    }

    // Proses per role
    foreach ($request->roles as $permissionId => $roleName) {
        // Cari role yang sesuai
        $role = DB::table('roles')->where('name', $roleName)->first();

        if (!$role) {
            return response()->json(['errors' => 'Role tidak ditemukan!'], 404);
        }

        // Cek apakah sudah ada RolePermission untuk permission ini
        $existingRolePermission = DB::table('role_permissions')
    ->where('permission_id', $permissionId)
    ->where('user_id', $request->id)
    ->first();

if ($existingRolePermission) {
    // Update jika sudah ada
    DB::table('role_permissions')
        ->where('id', $existingRolePermission->id)
        ->update([
            'role_id' => $role->id,
            'updated_at' => now(),
        ]);
} else {
    // Insert jika belum ada
    DB::table('role_permissions')->insert([
        'permission_id' => $permissionId,
        'role_id' => $role->id,
        'user_id' => $request->id,
        'created_at' => now(),
        'updated_at' => now(),
    ]);
}

    }

    return response()->json(['success' => 'Data Berhasil Disimpan!']);
        }

        return response()->json(['error' => 'Anda Tidak Memiliki Akses']);
    
}



 public static function show(Request $request)
    {



    $draw   = intval(request('draw'));
    $start  = intval(request('start'));
    $length = intval(request('length'));
    $search = request('search.value');

    $output = [
        'draw' => $draw,
        'recordsTotal' => DB::table('anggota')->count(),
        'recordsFiltered' => 0,
        'data' => [],
    ];

    $permission = 5;
           $user = Auth::user();
           $ksp = $user->name;

           $rolepermission = DB::table('role_permissions')->join('roles', 'roles.id', '=', 'role_permissions.role_id')
                ->where('user_id', $user->id)
                ->where('permission_id', $permission)
                ->select('roles.name')
                ->first();
             
              $role = $rolepermission->name ?? null;  
             $allowedRoles = ['Super Admin'];

    // Base Query
    $baseQuery = DB::table('users');
                // ->whereBetween('user.tgl_registrasi', [$request->t_awal, $request->t_akhir])
    // Search filter
    if (!empty($search)) {
        $baseQuery->where(function($filter) use ($search) {
             $filter->orWhere('name', 'like', '%' . $search . '%');        
              $filter->orWhere('email', 'like', '%' . $search . '%');
 
        })->where('name' ,'!=', 'Ketua Sp');
    }

    // Clone query for counting filtered records
    $filteredCount = (clone $baseQuery)->count();

    // Data fetching
    $data = $baseQuery
        ->orderByDesc('id')
        ->where('name' ,'!=', 'Ketua Sp')
        ->skip($start)
        ->take($length)
        ->get();

    // Build data array
    $no = $start + 1;
    foreach ($data as $val) {

    $id = Crypt::encrypt($val->id);

      if ($ksp == 'Ketua Sp' || ($rolepermission && in_array($rolepermission->name, $allowedRoles))) {
          $data = '    <a class="dropdown-item text-primary" onclick="detail(\''. $id .'\')" href="#"><i class="icon-base ti tabler-list-details me-1"></i> Detail</a>
                              <a class="dropdown-item text-warning" onclick="edit(\''. $id .'\')" href="#"><i class="icon-base ti tabler-id me-1"></i> Beri Akses</a>
                              <a class="dropdown-item text-danger" onclick="hapus(\''. $id .'\')" href="#"><i class="icon-base ti tabler-trash me-1"></i> Delete</a>';
        }else {
          return response()->json(['error' => 'Anda Tidak Memiliki Akses']);
        }
        
        $output['data'][] = [
          "<td>$no</td>",
          "<td>$val->name</td>",
          "<td>$val->email</td>",
           '<td>
               <div class="dropdown pe-4">
                  <button type="button" class="btn btn-secondary btn-sm text-white" data-bs-toggle="dropdown"> Action
                      <i class="ms-1 icon-base ti tabler-brand-juejin icon-15px"></i></button>
                          <div class="dropdown-menu">   
                           '.$data.'
                             
                           </div>
                </div>
                   
          </td>'
        ];
        $no++;
    }

    $output['recordsFiltered'] = $filteredCount;
    return response()->json($output);
        
    }

}