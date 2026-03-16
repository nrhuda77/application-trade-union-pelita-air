<?php

namespace Modules\EventPengumuman\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendEmail;
use App\Helpers\LogActivity;
use Illuminate\Support\Facades\Crypt;

class CrudEventPengumumanController extends Controller
{

     public static function store(Request $request)
    {

      $permission = 4;
      $user = Auth::user();
      $ksp = $user->name;

      $rolepermission = DB::table('role_permissions')->join('roles', 'roles.id', '=', 'role_permissions.role_id')
          ->where('user_id', $user->id)
          ->where('permission_id', $permission)
          ->select('roles.name')
          ->first();

      $allowedRoles = ['Super Admin', 'Editor'];

      if ($ksp == 'Ketua Sp' || ($rolepermission && in_array($rolepermission->name, $allowedRoles))) {
           $validatedData = $request->validate([
            'judul' => 'required',
            'isi' => 'required',
            'lampiran' => 'nullable|mimes:jpeg,png,jpg,pdf|max:10800',
            'status' => 'required',
            'visibilitas' => 'required',
            'kategori' => 'required'
        ], [
            'judul.required' => 'Judul wajib diisi.',
            'isi.required' => 'Isi wajib diisi.',
            'status.required' => 'Status wajib diisi.',
            'visibilitas.required' => 'Visibilitas wajib diisi.',
            'kategori.required' => 'Kategori wajib diisi.',
        ]);

        if ($request->lampiran == '' || $request->lampiran == null) {
            $newUrl = null;
        } else {

            $fileName = time() . '-lampiran.' . $request->lampiran->extension();
            $time = time();
            $data = base_path('pengumuman-file/' . $time);
            if (!File::exists($data)) {
                File::makeDirectory($data, 0755, true); // Membuat folder dengan permission 0755
                $request->lampiran->move(base_path('pengumuman-file/' . $time), $fileName);
            }
            $newUrl = 'event-lampiran/' . $time . '/' . $fileName;
        }
        $uuid = Str::random(100);

        DB::table('pengumuman')->insert([
            'judul' => $request->judul,
            'isi' => $request->isi,
            'lampiran' => $newUrl,
            'kategori' => $request->kategori,
            'status' => $request->status,
            'visibilitas' => $request->visibilitas,
            'waktu_event' => $request->waktu_event,
            'lokasi_event' => $request->lokasi_event,
            'uuid' => 1,
        ]);
        
        if($request->visibilitas == 'private'){
            $data = [
    'judul' => $request->judul,
    'isi' => $request->isi,
    'lampiran' => 'https://sppelitaair.org/'.$newUrl,
    'kategori' => $request->kategori,
    'visibilitas' => $request->visibilitas,
    'waktu_event' => $request->waktu_event,
    'lokasi_event' => $request->lokasi_event,
];
            
            Mail::to('nrhuda777@gmail.com')->send(new SendEmail($data, 'email::event'));

            

        }

        LogActivity::log_activity('Membuat Pengumuman');
        return response()->json(['status' => 'success']);
        }

        return response()->json(['error' => 'Anda Tidak Memiliki Akses']);
      
     }

         public static function show(Request $request)
    {
        $query = DB::table('pengumuman')->paginate(8); // Halaman 8 per request

        $data = '';
        foreach ($query as $q) {
$defaultImage = 'https://blog-edutore-partner.s3.ap-southeast-1.amazonaws.com/wp-content/uploads/2021/05/17004942/Jurusan-Desain-Grafis_626-x-626.png';

$lampiranUrl = $q->lampiran ? url($q->lampiran) : $defaultImage;
$id = Crypt::encrypt($q->id);

$data .= '
<div class="col-md-4 col-lg-3">
    <div class="card rounded-5">
        <img class="card-img-top fixed-thumb" src="'. $lampiranUrl .'" alt="Card Image">

        <div class="card-body">
            <h6 class="card-title">'. $q->judul .'</h6>

            <div class="d-flex justify-content-between">
                <a style="cursor: pointer;" onclick="edit(\''. $id .'\')" class="btn btn-warning text-white">Berita</a>
                <a style="cursor: pointer;" onclick="hapus(\''. $id .'\')" class="btn btn-danger text-white">Hapus</a>
            </div>
        </div>
    </div>
</div>
';

        }

        return response()->json([
            'html' => $data,
            'next_page' => $query->nextPageUrl() // Menyediakan URL untuk halaman selanjutnya
        ]);
    }


       public static function destroy($id)
    {
       $pengumuman = DB::table('pengumuman')->where('id', $id)->first();

// Jika tidak ada → 404
if (!$pengumuman) {
    abort(404, 'Pengumuman tidak ditemukan.');
}

// Hapus file jika ada
if ($pengumuman->lampiran) {
    $filePath = base_path($pengumuman->lampiran);

    if (file_exists($filePath)) {
        @unlink($filePath);
    }
}

// Hapus data dari database
DB::table('pengumuman')->where('id', $id)->delete();

return response()->json(['success' => true]);
    }


}