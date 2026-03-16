<?php

namespace Modules\AnggotaSerikat\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class AnggotaSerikatController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $permission = 2;
      $user = Auth::user();
      $ksp = $user->name;

      $rolepermission = DB::table('role_permissions')->join('roles', 'roles.id', '=', 'role_permissions.role_id')
          ->where('user_id', $user->id)
          ->where('permission_id', $permission)
          ->select('roles.name')
          ->first();

      $allowedRoles = ['Super Admin', 'Editor', 'Viewer'];

      if ($ksp == 'Ketua Sp' || ($rolepermission && in_array($rolepermission->name, $allowedRoles))) {
          return view('anggotaserikat::admin.index');
        }

        return redirect('/dashboard');
       
    }

    public function ajax_data(Request $request, $id){

        $permission = 2;
      $user = Auth::user();
      $ksp = $user->name;

      $rolepermission = DB::table('role_permissions')->join('roles', 'roles.id', '=', 'role_permissions.role_id')
          ->where('user_id', $user->id)
          ->where('permission_id', $permission)
          ->select('roles.name')
          ->first();

      $allowedRoles = ['Super Admin', 'Editor', 'Viewer'];

      if ($ksp == 'Ketua Sp' || ($rolepermission && in_array($rolepermission->name, $allowedRoles))) {
                  $anggota = DB::table('anggota')->find(Crypt::decrypt($id));
                  return response()->json($anggota);
        }

                 return response()->json(['error' => 'Anda Tidak Memiliki Akses']);

       
    }

   
    public function store(Request $request) {}

    /**
     * Show the specified resource.
     */
    public function show(Request $request)
    {
        return CrudAnggotaSerikatController::show( $request);
    }

     
    public function update(Request $request) {
        return CrudAnggotaSerikatController::update( $request);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id) {}
}