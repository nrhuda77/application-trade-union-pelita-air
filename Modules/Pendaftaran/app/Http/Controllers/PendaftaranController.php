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

class PendaftaranController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
         $permission = 1;
      $user = Auth::user();
      $ksp = $user->name;

      $rolepermission = DB::table('role_permissions')->join('roles', 'roles.id', '=', 'role_permissions.role_id')
          ->where('user_id', $user->id)
          ->where('permission_id', $permission)
          ->select('roles.name')
          ->first();

      $allowedRoles = ['Super Admin', 'Editor', 'Viewer'];

      if ($ksp == 'Ketua Sp' || ($rolepermission && in_array($rolepermission->name, $allowedRoles))) {
          $pendaftaran = DB::table('pendaftaran')->orderBy("created_at", "desc")->get();
                  return view('pendaftaran::admin.index', compact('pendaftaran'));
        }

        return redirect('/dashboard');

    }

 
    
    public function approval(Request $request) {

       return CrudPendaftaranController::approve($request);
    }

    
    public function show(Request $request)
    {
       return CrudPendaftaranController::show($request);
    }

  
    public function ajax_data($id)
    {
      $permission = 1;
      $user = Auth::user();
      $ksp = $user->name;

      $rolepermission = DB::table('role_permissions')->join('roles', 'roles.id', '=', 'role_permissions.role_id')
          ->where('user_id', $user->id)
          ->where('permission_id', $permission)
          ->select('roles.name')
          ->first();

      $allowedRoles = ['Super Admin', 'Editor', 'Viewer'];

      if ($ksp == 'Ketua Sp' || ($rolepermission && in_array($rolepermission->name, $allowedRoles))) {
                 $pendaftaran = DB::table('pendaftaran')->find(Crypt::decrypt($id));
                 return response()->json($pendaftaran);
        }

                 return response()->json(['error' => 'Anda Tidak Memiliki Akses']);
    }

 
    public function update(Request $request) {
        return CrudPendaftaranController::update($request);
    }

     public function import(Request $request) {
        return CrudPendaftaranController::import_excel($request);
    }

      public static function result($email,$uuid)
    {

        $pendaftaran = DB::table('pendaftaran')->where('uuid', $uuid)->first();

        if($pendaftaran?->status_pendaftaran == 'approved'){
            return view('pendaftaran::anggota.page-result.proses',['uuid' => $uuid, 'email' => $email]);
        }else if($pendaftaran?->status_pendaftaran == 'pending'){
            return view('pendaftaran::anggota.page-result.waiting');
        }else if($pendaftaran?->status_pendaftaran == 'rejected'){
            return view('pendaftaran::anggota.page-result.reject');
        }else{
            return view('eror-page');
        }
        
    }
  
    public function destroy($id) {}
}