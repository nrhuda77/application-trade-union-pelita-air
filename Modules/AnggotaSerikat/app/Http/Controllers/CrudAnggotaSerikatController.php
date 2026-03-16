<?php

namespace Modules\AnggotaSerikat\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\File;

class CrudAnggotaSerikatController extends Controller
{


 public static function update(Request $request)
{
    $permission = 2;
    $user       = Auth::user();
    $ksp        = $user->name;

    // --- Cek role ---
    $rolepermission = DB::table('role_permissions')
        ->join('roles', 'roles.id', '=', 'role_permissions.role_id')
        ->where('user_id', $user->id)
        ->where('permission_id', $permission)
        ->select('roles.name')
        ->first();

    $allowedRoles = ['Super Admin', 'Editor'];

    if (!($ksp == 'Ketua Sp' || ($rolepermission && in_array($rolepermission->name, $allowedRoles)))) {
        return response()->json(['error' => 'Anda Tidak Memiliki Akses']);
    }

    // --- Validasi ---
    $validated = $request->validate([
        'nama'          => 'required',
        'nik'           => 'required|numeric',
        'tempat_lahir'  => 'required',
        'tanggal_lahir' => 'required|date',
        'alamat'        => 'required',
        'no_hp'         => 'required|numeric',
        'email'         => 'required|email',
    ]);

    $anggotaId = Crypt::decrypt($request->id);
    $anggota   = DB::table('anggota')->find($anggotaId);

    // --- Helper untuk upload gambar ---
    $uploadFile = function ($file, $oldPath, $prefix, $defaultFolder) {
        if (!$file) return $oldPath;

        // Tentukan folder
        if (preg_match("/data-foto-\d+-\d+/", $oldPath, $m)) {
            $folderName = $m[0];
        } else {
            $folderName = $defaultFolder;
        }

        $folder = base_path('assets/' . $folderName);
        if (!File::exists($folder)) File::makeDirectory($folder, 0755, true);

        // Nama file baru
        $fileName = time() . '-' . $prefix . '.' . $file->extension();

        // Upload file baru
        $file->move($folder, $fileName);

        // Hapus file lama jika ada
        $oldRealPath = base_path(str_replace("gambar/", "assets/", $oldPath));
        if (File::exists($oldRealPath)) File::delete($oldRealPath);

        return 'gambar/' . $folderName . '/' . $fileName;
    };

    // --- Upload file ---
    $urlIdCard = $uploadFile($request->file('upload_id_card'), $anggota->upload_id_card, 'id_card', 'id_card_temp');
    $urlSelfie = $uploadFile($request->file('upload_selfie'), $anggota->upload_selfie, 'wajah', 'selfie_temp');

    // --- Data untuk update ---
    $updateData = [
        'nama'          => $request->nama,
        'nik'           => $request->nik,
        'nip'           => $request->nip,
        'tempat_lahir'  => $request->tempat_lahir,
        'tanggal_lahir' => $request->tanggal_lahir,
        'alamat'        => $request->alamat,
        'no_hp'         => $request->no_hp,
        'email'         => $request->email,
        'status'        => $request->status,
        'username'      => $request->username,
        'upload_id_card'=> $urlIdCard,
        'upload_selfie' => $urlSelfie
    ];

    // Update password jika diisi
    if ($request->filled('password')) {
        $updateData['password'] = bcrypt($request->password);
    }

    // --- Update database sekali saja ---
    DB::table('anggota')->where('uuid', $anggota->uuid)->update($updateData);

    return response()->json(['success' => true, 'data' => $updateData]);
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

    $permission = 2;
           $user = Auth::user();
           $ksp = $user->name;

           $rolepermission = DB::table('role_permissions')->join('roles', 'roles.id', '=', 'role_permissions.role_id')
                ->where('user_id', $user->id)
                ->where('permission_id', $permission)
                ->select('roles.name')
                ->first();
             
            $role = $rolepermission->name ?? null;  

    // Base Query
    $baseQuery = DB::table('anggota');
                // ->whereBetween('anggota.tgl_registrasi', [$request->t_awal, $request->t_akhir])
    // Search filter
    if (!empty($search)) {
        $baseQuery->where(function($filter) use ($search) {
             $filter->orWhere('nama', 'like', '%' . $search . '%');
              $filter->orWhere('nik', 'like', '%' . $search . '%');
              $filter->orWhere('email', 'like', '%' . $search . '%');
              $filter->orWhere('no_hp', 'like', '%' . $search . '%');
              $filter->orWhere('alamat', 'like', '%' . $search . '%');
              $filter->orWhere('tempat_lahir', 'like', '%' . $search . '%');
              $filter->orWhere('tanggal_lahir', 'like', '%' . $search . '%');
        });
    }

    // Clone query for counting filtered records
    $filteredCount = (clone $baseQuery)->count();

    // Data fetching
    $data = $baseQuery
        ->orderByDesc('id')
        ->skip($start)
        ->take($length)
        ->get();

    // Build data array
    $no = $start + 1;
    foreach ($data as $val) {

    $id = Crypt::encrypt($val->id);
    
    if ($val->status == 'aktif') {
        $sts = '<span class="btn btn-success btn-xs">Aktif</span>';
    } else {
        $sts = '<span class="btn btn-primary btn-xs">Tidak Aktif</span>';
    }



                // Base detail button
                $data = '<a class="dropdown-item text-info" onclick="detail(\''. $id.'\', \'\')"><i class="icon-base ti tabler-list-details me-1"></i> Detail</a>';

                // Add edit/delete depending on role
             if (in_array($role, ['Super Admin']) || $ksp === 'Ketua Sp') {
               $data .= '
                     <a class="dropdown-item text-warning" onclick="detail(\''. $id.'\', \'edit\')"><i class="icon-base ti tabler-edit me-1"></i> Edit</a>
                    <a class="dropdown-item text-danger" onclick="delete(\''. $id.'\')"><i class="icon-base ti tabler-trash me-1"></i> Hapus</a>';
            } elseif ($role === 'Editor') {
              $data .= '
                     <a class="dropdown-item text-warning" onclick="detail(\''. $id.'\', \'edit\')"><i class="icon-base ti tabler-edit me-1"></i> Edit</a>';
            } elseif ($role !== 'Viewer') {
                    return response()->json(['error' => 'Anda Tidak Memiliki Akses']);
            }


        
        $output['data'][] = [
          "<td>$no</td>",
          "<td>$val->nama</td>",
          "<td>$val->nik </td>",
          "<td>$val->email</td>",
          "<td>{$sts}</td>",    
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