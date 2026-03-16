<?php
namespace Modules\Pelaporan\Http\Controllers;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\File;


class CrudPelaporanAnggotaController extends Controller
{
    public static function show (Request $request){
           $id= Auth::guard('anggota')->id();
           $anggota = DB::table('anggota')->find($id);
           $id_pelaporan = Crypt::encrypt($id);
          // dd($anggota);
          $query = DB::table('pelaporan')->where('uuid', $anggota->uuid)->paginate(8); // Halaman 8 per request

        $data = '';
        foreach ($query as $index => $q) {
            $cardNumber = str_pad($index + 1 + (($query->currentPage() - 1) * 8), 2, '0', STR_PAD_LEFT);

            // Tentukan background class berdasarkan status
            $bgClass = match ($q->status) {
                'Menunggu Tanggapan' => 'bg-warning',
                'Diproses' => 'bg-danger',
                'Selesai' => 'bg-success',
                'Pengumpulan Bukti Tambahan' => 'bg-info',
                'Penyelidikan Lebih Lanjut' => 'bg-primary',
                 default => 'bg-primary',
            };

              $iconClass = match ($q->status) {
                'Menunggu Tanggapan' => 'clock-hour-3',
                'Diproses' => 'clock-cog',
                'Selesai' => 'progress-check',
                'Pengumpulan Bukti Tambahan' => 'book-upload',
                'Penyelidikan Lanjut' => 'search',
                 default => 'clock-hour-3',
            };

            $detail_laporan = DB::table('detail_pelaporan')->where('pelaporan_id', $q->id)->where('uuid', $q->uuid)->where('status', 'Pengumpulan Bukti Tambahan')->where('lampiran', '=', null)->latest()->first();

            // Kode HTML untuk card (kondisi anonim ditangani di sini)
            $data .= '
            <div class="col-xl-3 col-lg-6 col-md-6 mt-3">
                  <div class="card">
                    <div class="card-body">
                      <div class="d-flex align-items-center mb-1 pb-1">
                          <div class="me-2 text-heading h5 mb-0">'.$q->jenis_pelaporan.'</div>       
                        <div class="ms-auto">
                             <a style="cursor: pointer;" onclick="histori(\''. Crypt::encrypt($q->id).'\', \'\')" class="mt-2"><span class="mt-2 badge bg-label-info" ><i class="me-1 icon-base ti tabler-history icon-15px"></i>  History</span></a>
                        </div>
                      </div>
                      <p class="mb-1 pb-1">'.$q->judul.'</p>

                      <div class="  mb-5 justify-content-between">
                         <span class=" badge badge '.$bgClass.'"><i class="me-1 icon-base ti tabler-'.$iconClass.' icon-15px"></i>'.$q->status.'</span> 
                     '.($q->anonim == 1   ? '<br><span class="mt-3 badge bg-secondary"><i class="me-1 icon-base ti tabler-spy icon-15px"></i> Anonim</span>' : '').'
                      </div>
                      
                      <div class="d-flex align-items-center">
                       
                        <div class="ms-auto">
                        '.($detail_laporan == null ? '' : '<a style="cursor: pointer;" onclick="upload(\''. Crypt::encrypt($q->id).'\', \'\')" class="mt-2"><span class="mt-2 badge bg-label-success"><i class="me-1 icon-base ti tabler-upload icon-15px"></i>  Upload</span></a>').'
                        '.($q->status == 'Menunggu Tanggapan' ? '
                         <a style="cursor: pointer;" onclick="edit(\''. $id_pelaporan.'\', \'\')" class="mt-2"><span class="mt-2 badge bg-label-warning"><i class="me-1 icon-base ti tabler-edit icon-15px"></i> Edit</span></a>
                         <a style="cursor: pointer;" onclick="hapus(\''. $id_pelaporan.'\', \'\')" class="mt-2"><span class="mt-2 badge bg-label-danger"><i class="me-1 icon-base ti tabler-circle-dashed-x icon-15px"></i> Batalkan</span></a>
                        ' : '').'
                        <a style="cursor: pointer;" target="_blank" href="/detail-laporan-keluhan-anggota/'. Crypt::encrypt($q->id).'" class="mt-2"><span class="mt-2 badge bg-label-primary"><i class="me-1 icon-base ti tabler-id icon-15px"></i> Detail</span></a>
                        </div>
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


    public static function store(Request $request)
    {
        $validatedData = $request->validate([
            'jenis_pelaporan' => 'required',
            'judul' => 'required',
            'isi' => 'required',
            'lampiran' => 'required',
            'anonim' => 'nullable'
        ],[
            'jenis_pelaporan.required' => 'Jenis pelaporan wajib diisi.',
            'judul.required' => 'Judul wajib diisi.',
            'isi.required' => 'Isi wajib diisi.',
            'lampiran.required' => 'Lampiran wajib diunggah.',
        ]);

        $guard = Auth::guard('anggota')->id();
        $anggota = DB::table('anggota')->find($guard);
        $pendaftaran = DB::table('pendaftaran')->where('uuid', $anggota->uuid)->first();
        if ($request->lampiran == '' || $request->lampiran == null) {
          $newUrl = null;
        }else{
          $oldfilePath = $pendaftaran->upload_id_card;
          $imageName = time().'-lampiran.'.$request->lampiran->extension();
          preg_match('#^gambar/([^/]+)/#', $oldfilePath, $matches);
          $folder = base_path('assets/'.$matches[1]);
          if (!File::exists(  $folder)) {
              File::makeDirectory(  $folder, 0755, true); // Membuat folder dengan permission 0755
              $request->lampiran->move(base_path('assets/'.$matches[1]), $imageName);
          }else{
              $request->lampiran->move(base_path('assets/'.$matches[1]), $imageName);
          }

        $newUrl = 'gambar/'.$matches[1].'/'.$imageName;
        }

            $tanggal = Carbon::now()->addDays(15);

         $pelaporan_id = DB::table('pelaporan')->insertGetId([
            'jenis_pelaporan' => $request->jenis_pelaporan,
              'uuid'         => $anggota->uuid,
            'judul' => $request->judul,
            'anonim' => $request->anonim,
            'status' => 'Menunggu Tanggapan',
            'tanggapan' => $tanggal = Carbon::now()->addDays(15),
            'tenggat' => $tanggal,
            
        ]);

        DB::table('detail_pelaporan')->insert([
        'pelaporan_id' => $pelaporan_id,
        'uuid'         => $anggota->uuid,
        'lampiran'     => $newUrl,
        'isi'          => $request->isi,
        'status' => 'Menunggu Tanggapan',
        'created_at'   => now(),
    ]);

        return response()->json($request);
    }

    public static function update(Request $request){

        $guard = Auth::guard('anggota')->id();
        $anggota = DB::table('anggota')->find($guard);
        $data = DB::table('pelaporan')->where('uuid', $anggota->uuid)->first();
        if ($request->lampiran == '' || $request->lampiran == null) {
          $newUrl = null;
        }else{
          $oldfilePath = $data->lampiran;
          $pathImageUrl = base_path(str_replace("gambar/", "assets/", $oldfilePath));
          $imageName = time().'-lampiran_tambahan.'.$request->lampiran->extension();
          preg_match('#^gambar/([^/]+)/#', $oldfilePath, $matches);
          $folder = base_path('assets/'.$matches[1]);
          if (!File::exists(  $folder)) {
              File::makeDirectory(  $folder, 0755, true); // Membuat folder dengan permission 0755
              $request->lampiran->move(base_path('assets/'.$matches[1]), $imageName);
          }else{
              $request->lampiran->move(base_path('assets/'.$matches[1]), $imageName);
          }

        $newUrl = 'gambar/'.$matches[1].'/'.$imageName;
        }

        $tanggal = Carbon::now()->addDays(7);
        $cek_d_awal = DB::table('detail_pelaporan')->where('pelaporan_id', $request->id)->where('status', 'Menunggu Tanggapan')->latest()->first();
          if ($cek_d_awal != null) {
            $lampiran = $cek_d_awal->lampiran ?? '';
          }
        $request_data = DB::table('pelaporan')->where('id', $request->id)->update([
          'lampiran_tambahan' => $newUrl,
          'status' => 'Penyelidikan Lanjut',
          'tenggat' => $tanggal
      ]);

    
      return response()->json( $request_data);
    }


    public static function update_upload_tambahan(Request $request){

        $guard = Auth::guard('anggota')->id();
        $anggota = DB::table('anggota')->find($guard);
        $data = DB::table('pelaporan')->where('uuid', $anggota->uuid)->first();
        if ($request->lampiran == '' || $request->lampiran == null) {
          $newUrl = null;
        }else{

          $imageName = time().'-lampiran_tambahan.'.$request->lampiran->extension();
          $folder = base_path('assets/'.$imageName);
          if (!File::exists(  $folder)) {
              File::makeDirectory(  $folder, 0755, true); // Membuat folder dengan permission 0755
              $request->lampiran->move(base_path('assets/'.$imageName), $imageName);
          }else{
              $request->lampiran->move(base_path('assets/'.$imageName), $imageName);
          }

        $newUrl = 'gambar/'.$imageName.'/'.$imageName;
        }

        $tanggal = Carbon::now()->addDays(7);
      

      // dd($request->all());

      $cek_detail = DB::table('detail_pelaporan')->where('id', $request->id)->where('pelaporan_id', $request->pelaporan_id)->where('uuid', $request->uuid)->where('status', 'Pengumpulan Bukti Tambahan')->latest()->first();

        if($cek_detail) {
            DB::table('pelaporan')->where('id', $request->pelaporan_id)->where('uuid', $request->uuid)->update([
                        'tenggat' => $tanggal ,
                        'status' => 'Penyelidikan Lanjut',
            ]);

            DB::table('detail_pelaporan')->where('id', $request->id)->where('pelaporan_id', $request->pelaporan_id)->where('uuid', $request->uuid)->where('status', 'Pengumpulan Bukti Tambahan')->update([
                'lampiran' => $newUrl,
                'created_at' => Carbon::now(),
            ]);

            DB::table('detail_pelaporan')->insert([
                'pelaporan_id' => $request->pelaporan_id,
                'uuid' => $request->uuid,
                'isi' => $request->isi,
                'lampiran' => $newUrl,
                'status' => 'Penyelidikan Lanjut',
                'status_baca' => 0,
                'tanggapan' => '',
                'created_at' => Carbon::now(),
            ]);
      }

    
      return response()->json( $cek_detail);
    }
}