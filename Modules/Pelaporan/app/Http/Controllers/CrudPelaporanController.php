<?php

namespace Modules\Pelaporan\Http\Controllers;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\File;


class CrudPelaporanController extends Controller
{
   public static function show(Request $request) {

    $draw   = intval(request('draw'));
    $start  = intval(request('start'));
    $length = intval(request('length'));
    $search = request('search.value');

    $output = [
        'draw' => $draw,
        'recordsTotal' => DB::table('pelaporan')->count(),
        'recordsFiltered' => 0,
        'data' => [],
    ];

    $permission = 3;
           $user = Auth::user();
           $ksp = $user->name;

           $rolepermission = DB::table('role_permissions')->join('roles', 'roles.id', '=', 'role_permissions.role_id')
                ->where('user_id', $user->id)
                ->where('permission_id', $permission)
                ->select('roles.name')
                ->first();
             
            $role = $rolepermission->name ?? null;  

    // Base Query
    $baseQuery = DB::table('pelaporan');
                // ->whereBetween('pelaporan.tgl_registrasi', [$request->t_awal, $request->t_akhir])
    // Search filter
    if (!empty($search)) {
        $baseQuery->where(function($filter) use ($search) {
             $filter->orWhere('judul', 'like', '%' . $search . '%');
              $filter->orWhere('jenis_pelaporan', 'like', '%' . $search . '%');
              $filter->orWhere('status', 'like', '%' . $search . '%');
              $filter->orWhere('tenggat', 'like', '%' . $search . '%');
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
    
  $statusColor = [
    'Menunggu Tanggapan'        => 'btn-danger',   // kuning
    'Diproses'                  => 'btn-warning',   // biru
    'Selesai'                   => 'btn-success',   // hijau
    'Penyelidikan Lebih Lanjut' => 'btn-info',      // biru muda
    'Pengumpulan Bukti Tambahan' => 'btn-secondary' // abu-abu
];

// fallback warna jika status tidak ditemukan
$color = $statusColor[$val->status] ?? 'btn-dark';

$sts = "<span class='btn btn-xs $color'>{$val->status}</span>";




                // Base detail button
          $data = '<a class="dropdown-item text-info" target="_blank" href="/detail-laporan-keluhan/'.$id.'">
                <i class="icon-base ti tabler-list-details me-1"></i> Detail
             </a>';

// Cek status
if ($val->status !== 'Selesai') {

    $data = '<a class="dropdown-item text-info" href="/detail-laporan-keluhan/'.$id.'">
                <i class="icon-base ti tabler-list-details me-1"></i> Detail
             </a>';

    // Add edit/delete depending on role
    if (in_array($role, ['Super Admin']) || $ksp === 'Ketua Sp') {
        $data .= '
    
             <a class="dropdown-item text-danger" onclick="delete(\''. $id.'\')">
                <i class="icon-base ti tabler-trash me-1"></i> Hapus
             </a>
             <a class="dropdown-item text-success" onclick="tanggapan(\''. $id.'\')">
                <i class="icon-base ti tabler-inbox me-1"></i>Lihat & Tanggapi
             </a>';
    } elseif ($role !== 'Viewer') {
        return response()->json(['error' => 'Anda Tidak Memiliki Akses']);
    }
}

// Jika $val->status == 'Selesai', $data tetap kosong



        
        $output['data'][] = [
          "<td>$no</td>",
          "<td>$val->jenis_pelaporan</td>",
          "<td>$val->judul </td>",
        //   "<td>$val->email</td>",
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

        public static function update(Request $request)
    {
        $value = $request->value;

          $updateData = ['status' => $value];

   
        $data = DB::table('pelaporan')->where('id', $request->id)->where('uuid', $request->uuid)->update($updateData);

        $pelaporan = DB::table('pelaporan')->where('id', $request->id)->where('uuid', $request->uuid)->first();
        $cek_detail = DB::table('detail_pelaporan')->where('pelaporan_id', $request->id)->where('uuid', $request->uuid)->where('status', $value)->latest()->first();

        if($value == $request->status) {
             DB::table('detail_pelaporan')->where('pelaporan_id', $request->id)->where('uuid', $request->uuid)->where('status', $value)->update([
            'status' => $value,
            'tanggapan' => $request->tanggapan
        ]);
        }
        
        if($value != $request->status || $request->status == 'Pengumpulan Bukti Tambahan') {
            

        DB::table('detail_pelaporan')->insert([
            'pelaporan_id' => $request->id,
            'uuid' => $request->uuid,
            'isi' => '',
            'status' => $value,
            'status_baca' => 1,
            'tanggapan' => $request->tanggapan,
            'created_at' => Carbon::now(),
        ]);



        $cek_d_awal = DB::table('detail_pelaporan')->where('pelaporan_id', $request->id)->where('uuid', $request->uuid)->where('status', 'Menunggu Tanggapan')->first();
        $cek_d_kedua = DB::table('detail_pelaporan')->where('pelaporan_id', $request->id)->where('uuid', $request->uuid)->where('status', 'Penyelidikan Lanjut')->first();
        $lampiran = $cek_d_awal->lampiran ?? '';
        $lampiran2 = $cek_d_kedua->lampiran ?? '';
        
        if($lampiran2 == null || $lampiran2 == '') {
            DB::table('detail_pelaporan')->where('pelaporan_id', $request->id)->where('uuid', $request->uuid)->where('status', 'Penyelidikan Lanjut')->update([
                'lampiran' =>  $lampiran,
            ]);
        }
            $cek_d_last = DB::table('detail_pelaporan')->where('pelaporan_id', $request->id)->where('uuid', $request->uuid)->where('status', 'Penyelidikan Lanjut')->latest()->first();
 
         if($value == 'Selesai') {
            DB::table('detail_pelaporan')->where('pelaporan_id', $request->id)->where('uuid', $request->uuid)->where('status', 'Selesai')->update([
                'lampiran' =>   $cek_d_last->lampiran,
            ]);
        }
          
        }
       
        return response()->json($data);
    }

}