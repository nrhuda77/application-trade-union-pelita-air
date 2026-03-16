<?php

namespace Modules\Pendaftaran\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Mail\SendEmail;
 
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;

class PendaftaranAnggotaController extends Controller
{
     
    public function index()
    {
          return view('pendaftaran::anggota.index');

    }


      public function store(Request $request) {
        return CrudPendaftaranAnggotaController::store($request);
      }
    
        public function cek($nama, $nip)
    {
        $pendaftar = DB::table('pendaftaran')->where('nip', $nip)->where('nama', 'like', '%' . $nama . '%')->first();
        $anggota = DB::table('anggota')->where('nip', $nip)->orWhere('nama', 'like', '%' . $nama . '%')->first();
        return response()->json([$pendaftar, $anggota]);
    }



    public function send_text_email($email, $uuid) {
        return CrudPendaftaranAnggotaController::send_text_email($email, $uuid);
    }

  
    public function destroy($id) {}
}