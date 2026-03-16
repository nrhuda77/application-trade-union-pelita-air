<?php

namespace Modules\LaporanKeuangan\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Helpers\LogActivity;
use Carbon\Carbon;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Shared\Date as ExcelDate;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;

class LaporanKeuanganController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('laporankeuangan::admin.index');
    }
  public function anggota()
    {
        return view('laporankeuangan::anggota.index');
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('laporankeuangan::create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request) {}

   
   

        public static function import (Request $request)
{
    $request->validate([
        'excel_keuangan' => 'required|file|mimes:xlsx,xls'
    ]);

    try {

        $file = $request->file('excel_keuangan');
        $spreadsheet = IOFactory::load($file->getPathName());
        $sheet = $spreadsheet->getActiveSheet();

        $row = 7;
        $imported = [];
        $skipped = [];

        while (true) {

            $colF = $sheet->getCell('F' . $row)->getValue(); 
            $colG = $sheet->getCell('G' . $row)->getValue(); 
            $colH = $sheet->getCell('H' . $row)->getValue(); 
            $colI = $sheet->getCell('I' . $row)->getValue(); 


            // Hentikan jika dua kolom kosong
            if (empty($colF) && empty($colG) && empty($colH) && empty($colI)) {
                break;
            }
 

 

            $tanggal = ExcelDate::excelToDateTimeObject($colF)->format('Y-m-d');

            $cleanJumlah = preg_replace('/\D/', '', $colI); // hasil: 100000

            DB::table('laporan_keuangan')->insert([
                 'tanggal'    => $tanggal,
                 'keterangan' => $colG,
                 'kategori'   => $colH,
                 'jumlah'     => $cleanJumlah
            ]);
            

            $imported[] = [
                 'tanggal'    => $tanggal,
                 'keterangan' => $colG,
                 'kategori'   => $colH,
                 'jumlah'     => $cleanJumlah
            ];

          

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



  public static function show(Request $request)
    {

    $draw   = intval(request('draw'));
    $start  = intval(request('start'));
    $length = intval(request('length'));
    $search = request('search.value');

    $output = [
        'draw' => $draw,
        'recordsTotal' => DB::table('laporan_keuangan')->count(),
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
    $baseQuery = DB::table('laporan_keuangan');
                // ->whereBetween('laporan_keuangan.tgl_registrasi', [$request->t_awal, $request->t_akhir])
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
 

    //  $apr = in_array($role, ['Super Admin']) || $ksp === 'Ketua Sp'
    //                    ? ($val->status_pendaftaran !== 'approved' 
    //                    ? '   <a class="dropdown-item text-secondary" onclick="approve(\''. $id.'\')"><i class="icon-base ti tabler-copy-check me-1"></i> Approve</a>' 
    //                       : '')
    //                  : '';

    //             // Base detail button
    //             $data = '<a class="dropdown-item text-info" onclick="detail(\''. $id.'\', \'\')"><i class="icon-base ti tabler-list-details me-1"></i> Detail</a>';

    //             // Add edit/delete depending on role
    //          if (in_array($role, ['Super Admin']) || $ksp === 'Ketua Sp') {
    //            $data .= '
    //                  <a class="dropdown-item text-warning" onclick="detail(\''. $id.'\', \'edit\')"><i class="icon-base ti tabler-edit me-1"></i> Edit</a>
    //                 <a class="dropdown-item text-danger" onclick="delete(\''. $id.'\')"><i class="icon-base ti tabler-trash me-1"></i> Hapus</a>';
    //         } elseif ($role === 'Editor') {
    //           $data .= '
    //                  <a class="dropdown-item text-warning" onclick="detail(\''. $id.'\', \'edit\')"><i class="icon-base ti tabler-edit me-1"></i> Edit</a>';
    //         } elseif ($role !== 'Viewer') {
    //                 return response()->json(['error' => 'Anda Tidak Memiliki Akses']);
    //         }


        
        $output['data'][] = [
          "<td>$no</td>",
          "<td>$val->tanggal</td>",
          "<td>$val->keterangan </td>",
          "<td>$val->kategori</td>",   
          "<td>Rp " . number_format($val->jumlah, 0, ',', '.') . "</td>"
        //    '<td>
        //        <div class="dropdown pe-4">
        //           <button type="button" class="btn btn-success btn-sm text-white" data-bs-toggle="dropdown"> Action
        //               <i class="ms-1 icon-base ti tabler-brand-juejin icon-15px"></i></button>
        //                   <div class="dropdown-menu">   
        //                    '.$apr.'
        //                   '.$data.'
        //                    </div>
        //         </div>
                   
        //   </td>'
        ];
        $no++;
    }

    $output['recordsFiltered'] = $filteredCount;
    return response()->json($output);
        
    }

}