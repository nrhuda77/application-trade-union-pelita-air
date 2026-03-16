<?php

namespace Modules\Pelaporan\Http\Controllers;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;

class PelaporanController extends Controller
{
    public function index()
    {
         $permission = 3;
      $user = Auth::user();
      $ksp = $user->name;

      $rolepermission = DB::table('role_permissions')->join('roles', 'roles.id', '=', 'role_permissions.role_id')
          ->where('user_id', $user->id)
          ->where('permission_id', $permission)
          ->select('roles.name')
          ->first();

      $allowedRoles = ['Super Admin', 'Editor', 'Viewer'];

      if ($ksp == 'Ketua Sp' || ($rolepermission && in_array($rolepermission->name, $allowedRoles))) {
          return view('pelaporan::admin.index');
        }

        return redirect('/dashboard-admin');
    }

     public function view_anggota()
    {
          return view('pelaporan::anggota.index');
       
    }

    public function detail_admin($id)
    {
        $laporan = DB::table('pelaporan')->find(Crypt::decrypt($id));
        $detail_laporan = DB::table('detail_pelaporan')->where('pelaporan_id', Crypt::decrypt($id))->get();
        return view('pelaporan::admin.detail', compact('laporan', 'detail_laporan'));
    }

      public function detail_anggota($id)
    {
        $laporan = DB::table('pelaporan')->find(Crypt::decrypt($id));
        $detail_laporan = DB::table('detail_pelaporan')->where('pelaporan_id', Crypt::decrypt($id))->get();
        return view('pelaporan::anggota.detail', compact('laporan', 'detail_laporan'));
    }

        public function ajax_data(Request $request, $id)
    {

        $permission = 3;
      $user = Auth::user();
      $ksp = $user->name;

      $rolepermission = DB::table('role_permissions')->join('roles', 'roles.id', '=', 'role_permissions.role_id')
          ->where('user_id', $user->id)
          ->where('permission_id', $permission)
          ->select('roles.name')
          ->first();

      $allowedRoles = ['Super Admin', 'Editor', 'Viewer'];

      if ($ksp == 'Ketua Sp' || ($rolepermission && in_array($rolepermission->name, $allowedRoles))) {
                  $laporan = DB::table('pelaporan')->find(Crypt::decrypt($id));
                  $detail_laporan = DB::table('detail_pelaporan')->where('pelaporan_id', Crypt::decrypt($id))->latest()->first();
                 
                  if($laporan->anonim == 1){
                       $anggota = '';
                  }else{
                      $anggota = DB::table('anggota')->where('uuid', $laporan->uuid)->first();
                  }
 
                 return response()->json([$laporan, $detail_laporan, $anggota]);
                 
        }

                 return response()->json(['error' => 'Anda Tidak Memiliki Akses']);
        
    }


    public function ajax_data_anggota(Request $request, $id)
    {

          $laporan = DB::table('pelaporan')->find(Crypt::decrypt($id));
                 return response()->json($laporan);
        
    }

     public function ajax_data_histori(Request $request, $id)
    {

          $detail_laporan = DB::table('detail_pelaporan')->where('pelaporan_id', Crypt::decrypt($id))->get();
          return response()->json($detail_laporan);
        
    }

  public function ajax_data_upload(Request $request, $id)
    {

  
          $detail_laporan = DB::table('detail_pelaporan')->where('lampiran', '=', null)->where('status', 'Pengumpulan Bukti Tambahan')->where('pelaporan_id', Crypt::decrypt($id))->latest()->first();
         
          return response()->json($detail_laporan);
        
    }



    
        public function read(Request $request, $id)
    {

     
        $laporan = DB::table('pelaporan')->where('id', Crypt::decrypt($id))->first();

        $data = '';

        if($laporan->status_baca == 0) {
            $data = DB::table('pelaporan')->where('id', Crypt::decrypt($id))->update([
            'status' => 'Diproses',
            'status_baca' => 1
        ]);
        }

        DB::table('detail_pelaporan')->where('pelaporan_id', Crypt::decrypt($id))->update([
            'status_baca' => 1
        ]);
        return response()->json($data);
    }

 
    public function show(Request $request)
    {
        return CrudPelaporanController::show($request);
    }

      public function show_anggota(Request $request)
    {
        return CrudPelaporanAnggotaController::show($request);
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function update_upload_tambahan(Request $request)
    {
        return CrudPelaporanAnggotaController::update_upload_tambahan($request);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request) {
        return CrudPelaporanController::update($request);
    }

        public function store(Request $request) {
        return CrudPelaporanAnggotaController::store($request);
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id) {}
}