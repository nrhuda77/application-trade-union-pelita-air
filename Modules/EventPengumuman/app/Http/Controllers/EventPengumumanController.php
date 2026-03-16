<?php

namespace Modules\EventPengumuman\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class EventPengumumanController extends Controller
{
       public function index()
    {
      $permission = 4;
      $user = Auth::user();
      $ksp = $user->name;

      $rolepermission = DB::table('role_permissions')->join('roles', 'roles.id', '=', 'role_permissions.role_id')
          ->where('user_id', $user->id)
          ->where('permission_id', $permission)
          ->select('roles.name')
          ->first();

      $allowedRoles = ['Super Admin', 'Editor', 'Viewer'];

      if ($ksp == 'Ketua Sp' || ($rolepermission && in_array($rolepermission->name, $allowedRoles))) {
          return view("eventpengumuman::admin.index");
        }

        return redirect('/dashboard');
      
     }
           public function ajax_data(Request $request, $id)
    {

        $permission = 4;
        $user = Auth::user();
        $ksp = $user->name;

      $rolepermission = DB::table('role_permissions')->join('roles', 'roles.id', '=', 'role_permissions.role_id')
          ->where('user_id', $user->id)
          ->where('permission_id', $permission)
          ->select('roles.name')
          ->first();

      $allowedRoles = ['Super Admin', 'Editor', 'Viewer'];

      if ($ksp == 'Ketua Sp' || ($rolepermission && in_array($rolepermission->name, $allowedRoles))) {
                  $pengumuman = DB::table('pengumuman')->find($id);
                 return response()->json($pengumuman);
        }

                 return response()->json(['error' => 'Anda Tidak Memiliki Akses']);
        
    }


   
    public function store(Request $request) {
        return CrudEventPengumumanController::store($request);
    }

    /**
     * Show the specified resource.
     */
    public function show(Request $request)
    {
        return CrudEventPengumumanController::show( $request);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        return view('eventpengumuman::edit');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id) {}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id) {
        return CrudEventPengumumanController::destroy($id);
    }
}