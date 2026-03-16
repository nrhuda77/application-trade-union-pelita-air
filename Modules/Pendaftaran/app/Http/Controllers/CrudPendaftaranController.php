<?php

namespace Modules\Pendaftaran\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Mail\SendEmail;
use Illuminate\Support\Facades\Crypt;
use App\Helpers\LogActivity;
use PhpOffice\PhpSpreadsheet\IOFactory;
use Exception;
use Illuminate\Support\Str;

class CrudPendaftaranController extends Controller
{


   public static function approve(Request $request){

          $uuid = $request->uuid;
        $permission = 1;
        $user = Auth::user();
        $ksp = $user->name;

        $rolepermission = DB::table('role_permissions')->join('roles', 'roles.id', '=', 'role_permissions.role_id')
          ->where('user_id', $user->id)
          ->where('permission_id', $permission)
          ->select('roles.name')
          ->first();

        $allowedRoles = ['Super Admin'];
       
        if($request->status_pendaftaran == 'pending'){
          $status = '0';
        }else if($request->status_pendaftaran == 'approved'){
          $status = '1';
        }else if($request->status_pendaftaran == 'rejected'){
          $status = '2';
        }

    

      if ($ksp == 'Ketua Sp' || ($rolepermission && in_array($rolepermission->name, $allowedRoles))) {
         
          DB::table('pendaftaran')->where('id', Crypt::decrypt($request->id))->update([
                'status' => $status,
                'status_pendaftaran' => $request->status_pendaftaran,
                ]);
        
               if($request->status_pendaftaran == 'pending'){

               }else if($request->status_pendaftaran == 'approved'){
                $data = [
                  'name' => 'tester',
                  'body' => 'Pendaftaran Anda Disetujui Silahkan Klik Link Dibawah Untk Buat Akun Dengan Mengisi Username Password',
                  'uuid' => $uuid,
                  'link' => 'http://127.0.0.1:8000/registrasi/'.$uuid.'">Login </a>'
              ];
                  Mail::to('nrhuda777@gmail.com')->send(new SendEmail($data));
                  LogActivity::log_activity('Menyetujui Pendaftaran');
               }else{
                $data = [
                  'name' => 'tester',
                  'body' => 'Pendaftaran Anda Ditolak Silahkan Hubungi Customer Service / Admin yang Bersangkutan Untuk Verifikasi Data Anda',
                  'uuid' => $uuid,
                  'link' => ''
              ];
                 Mail::to('nrhuda777@gmail.com')->send(new SendEmail($data));
                 LogActivity::log_activity('Reject Pendaftaran');
               }

              
            return response()->json($request);
        }

          return response()->json(['error' => 'Anda Tidak Memiliki Akses']);
        
    }



    


    public static function update(Request $request)
{
    $user = Auth::user();
    $ksp  = $user->name;
    $permission = 1;

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
    $request->validate([
        'nama'          => 'required',
        'nik'           => 'required|numeric',
        'tempat_lahir'  => 'required',
        'tanggal_lahir' => 'required|date',
        'alamat'        => 'required',
        'no_hp'         => 'required|numeric',
        'email'         => 'required|email',
    ]);

    // --- Ambil Data ---
    $pendaftaranId = Crypt::decrypt($request->id);
    $pendaftaran   = DB::table('pendaftaran')->find($pendaftaranId);

    // ------------------------------
    // Helper Upload (modular, clean)
    // ------------------------------
    $uploadFile = function ($file, $oldPath, $prefix, $defaultFolder) {

        if (!$file) return $oldPath;

        // Tentukan folder file lama
        if (preg_match("/data-foto-\d+-\d+/", $oldPath, $m)) {
            $folderName = $m[0];
        } else {
            $folderName = $defaultFolder;
        }

        $folder = base_path("assets/$folderName");

        if (!File::exists($folder)) {
            File::makeDirectory($folder, 0755, true);
        }

        $fileName = time() . "-{$prefix}." . $file->extension();
        $file->move($folder, $fileName);

        // Hapus file lama jika ada
        $oldPhysical = base_path(str_replace("gambar/", "assets/", $oldPath));
        if (File::exists($oldPhysical)) {
            File::delete($oldPhysical);
        }

        return "gambar/{$folderName}/{$fileName}";
    };

    // --- Upload File ---
    $urlIdCard = $uploadFile(
        $request->file('upload_id_card'),
        $pendaftaran->upload_id_card,
        'id_card',
        'id_card_temp'
    );

    $urlSelfie = $uploadFile(
        $request->file('upload_selfie'),
        $pendaftaran->upload_selfie,
        'wajah',
        'selfie_temp'
    );

    // --- Update DB ---
    DB::table('pendaftaran')->where('id', $pendaftaranId)->update([
        'nama'           => $request->nama,
        'nik'            => $request->nik,
        'tempat_lahir'   => $request->tempat_lahir,
        'tanggal_lahir'  => $request->tanggal_lahir,
        'alamat'         => $request->alamat,
        'no_hp'          => $request->no_hp,
        'email'          => $request->email,
        'upload_id_card' => $urlIdCard,
        'upload_selfie'  => $urlSelfie,
    ]);

    return response()->json('success');
}


        

    public static function show(Request $request)
    {

    $draw   = intval(request('draw'));
    $start  = intval(request('start'));
    $length = intval(request('length'));
    $search = request('search.value');

    $output = [
        'draw' => $draw,
        'recordsTotal' => DB::table('pendaftaran')->count(),
        'recordsFiltered' => 0,
        'data' => [],
    ];

    $permission = 1;
           $user = Auth::user();
           $ksp = $user->name;

           $rolepermission = DB::table('role_permissions')->join('roles', 'roles.id', '=', 'role_permissions.role_id')
                ->where('user_id', $user->id)
                ->where('permission_id', $permission)
                ->select('roles.name')
                ->first();
             
            $role = $rolepermission->name ?? null;  

    // Base Query
    $baseQuery = DB::table('pendaftaran');
                // ->whereBetween('pendaftaran.tgl_registrasi', [$request->t_awal, $request->t_akhir])
    // Search filter
    if (!empty($search)) {
        $baseQuery->where(function($filter) use ($search) {
            $filter->orWhere('nama', 'like', '%' . $search . '%');
            $filter->orWhere('nik', 'like', '%' . $search . '%');
            $filter->orWhere('nip', 'like', '%' . $search . '%');
            $filter->orWhere('alamat', 'like', '%' . $search . '%');
            $filter->orWhere('no_hp', 'like', '%' . $search . '%');
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
    
    if ($val->status == 0) {
        $sts = '<span class="btn btn-danger btn-xs">Email Belum Pernah Dikirim </span>';
    } else {
        $sts = '<span class="btn btn-primary btn-xs">Email Sudah Pernah Dikirim </span>';
    }

     $apr = in_array($role, ['Super Admin']) || $ksp === 'Ketua Sp'
                       ? ($val->status_pendaftaran !== 'approved' 
                       ? '   <a class="dropdown-item text-secondary" onclick="approve(\''. $id.'\')"><i class="icon-base ti tabler-copy-check me-1"></i> Approve</a>' 
                          : '')
                     : '';

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
                  <button type="button" class="btn btn-success btn-sm text-white" data-bs-toggle="dropdown"> Action
                      <i class="ms-1 icon-base ti tabler-brand-juejin icon-15px"></i></button>
                          <div class="dropdown-menu">   
                           '.$apr.'
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


    public static function import_excel(Request $request)
{
    $request->validate([
        'excel_karyawan' => 'required|file|mimes:xlsx,xls'
    ]);

    try {

        $file = $request->file('excel_karyawan');
        $spreadsheet = IOFactory::load($file->getPathName());
        $sheet = $spreadsheet->getActiveSheet();

        $row = 5;
        $imported = [];
        $skipped = [];

        while (true) {

            $colC = $sheet->getCell('C' . $row)->getValue(); // NIP
            $colD = $sheet->getCell('D' . $row)->getValue(); // Nama

            // Hentikan jika dua kolom kosong
            if (empty($colC) && empty($colD)) {
                break;
            }

            // Cek duplikasi berdasarkan NIP saja
            $exists = DB::table('pendaftaran')
                ->where('nip', $colC)
                ->exists();

            if ($exists) {
                $skipped[] = [
                    'nip' => $colC,
                    'nama' => $colD,
                    'reason' => 'NIP sudah ada'
                ];

            } else {

                DB::table('pendaftaran')->insert([
                    'nip'  => $colC,
                    'nama' => $colD,
                ]);

                $imported[] = [
                    'nip' => $colC,
                    'nama' => $colD,
                ];
            }

            $row++;
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Proses import selesai.',
            'inserted_count' => count($imported),
            'skipped_count' => count($skipped),
            'inserted' => $imported,
            'skipped' => $skipped,
        ]);

    } catch (Exception $e) {

        return response()->json([
            'status' => 'error',
            'message' => 'Gagal mengimpor data.',
            'error' => $e->getMessage(),
        ], 500);
    }
}


      
     
}