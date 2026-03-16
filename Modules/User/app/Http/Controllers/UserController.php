<?php

namespace Modules\User\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('user::index');
    }

   public function store(Request $request){

        $validatedData = $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required',
            'role_id' => 'nullable'
        ], [
            'name.required' => 'Nama wajib diisi.',
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Email tidak valid.',
            'email.unique' => 'Email sudah terdaftar.',
            'password.required' => 'Password wajib diisi.',
        ]);


   
        User::create([
            'role_id' => '0',
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'status' => '1',
        ]);

        return response()->json(['success' => 'Data Berhasil Disimpan!']);

    }


    public function update(Request $request){

        $validatedData = $request->validate([
            'name' => 'required',
            'email' => 'required|email',
        ], [
            'name.required' => 'Nama wajib diisi.',
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Email tidak valid.',
        ]);

        if($request->password == null || $request->password == ""){
            User::where('id', $request->id)->update([
                'name' => $request->name,
                'email' => $request->email,
                'password' => bcrypt($request->password),
                'status' => 1,
                'role_id' => 0
            ]);
            return response()->json(['success' => 'Data Berhasil Diupdate!']); 
        }else{
            User::where('id', $request->id)->update([
            'name' => $request->name,
            'email' => $request->email,
            'status' => 1,
            'role_id' => 0 
        ]);   
        }

     
        return response()->json(['success' => 'Data Berhasil Diupdate!']); 
    }

    public function destroy($id,Request $request){
        User::where('id', Crypt::decrypt($id))->delete();
        return response()->json(['success' => 'Data Berhasil Dihapus!']); 
    }

    public function ajax_data(Request $request){
        $user = User::find(Crypt::decrypt($request->id));
        return response()->json($user);
    }

            public static function show(Request $request)
    {



    $draw   = intval(request('draw'));
    $start  = intval(request('start'));
    $length = intval(request('length'));
    $search = request('search.value');

    $output = [
        'draw' => $draw,
        'recordsTotal' => DB::table('users')->where('name' ,'!=', 'Ketua Sp')->count(),
        'recordsFiltered' => 0,
        'data' => [],
    ];

   

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
        
        $output['data'][] = [
          "<td>$no</td>",
          "<td>$val->name</td>",
          "<td>$val->email</td>",
           '<td>
               <div class="dropdown pe-4">
                  <button type="button" class="btn btn-secondary btn-sm text-white" data-bs-toggle="dropdown"> Action
                      <i class="ms-1 icon-base ti tabler-brand-juejin icon-15px"></i></button>
                          <div class="dropdown-menu">   
                              <a class="dropdown-item text-primary" onclick="detail(\''. $id .'\')" href="#"><i class="icon-base ti tabler-list-details me-1"></i> Detail</a>
                              <a class="dropdown-item text-warning" onclick="edit(\''. $id .'\')" href="#"><i class="icon-base ti tabler-edit me-1"></i> Edit</a>
                              <a class="dropdown-item text-danger" onclick="hapus(\''. $id .'\')" href="#"><i class="icon-base ti tabler-trash me-1"></i> Delete</a>
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