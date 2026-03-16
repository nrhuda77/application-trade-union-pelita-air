<?php

namespace Modules\MasukanSaran\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MasukanSaranAnggotaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('masukansaran::index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('masukansaran::create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request) {}

      public static function show(Request $request) {

    $draw   = intval(request('draw'));
    $start  = intval(request('start'));
    $length = intval(request('length'));
    $search = request('search.value');

    $output = [
        'draw' => $draw,
        'recordsTotal' => DB::table('masukan_saran')->count(),
        'recordsFiltered' => 0,
        'data' => [],
    ];

 
    // Base Query
    $baseQuery = DB::table('masukan_saran');
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

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        return view('masukansaran::edit');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id) {}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id) {}
}