<?php

namespace Modules\Pkb\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Mpdf\Mpdf;

class PkbController extends Controller
{
      public function index(){
        $nama = DB::table('anggota')->get();
        return view('pkb::index',[
            'anggota' => $nama
        ]);
    }

    public function cetak(Request $request){
         $data = DB::table('pdf_pkb')->where('uuid_anggota', $request->uuid)->first();
         $data2 = DB::table('anggota')->where('uuid', $request->uuid)->first();
         
        $path = base_path('pkb_file/PKB 2023-2025_SIGN.pdf');

        if (!file_exists($path)) {
            abort(404, 'File not found.');
        }

        $mpdf = new Mpdf([
            'tempDir' => storage_path('app/temp'), // optional, untuk temp file
        ]);

        $pagecount = $mpdf->setSourceFile($path);

        for ($i = 1; $i <= $pagecount; $i++) {
            $tplId = $mpdf->importPage($i);
            $mpdf->AddPage();
            $mpdf->useTemplate($tplId);

            // Watermark teks
            $mpdf->SetWatermarkText('Dokumen '.$data2->nama);
            $mpdf->showWatermarkText = true;
        }

        // Tambah proteksi PDF: bisa dibuka dengan password
        $mpdf->SetProtection(['print'],  $data2->tanggal_lahir,$data2->nip); // '1234' = password user

        return response($mpdf->Output('', 'S'))
            ->header('Content-Type', 'application/pdf')
            ->header('Content-Disposition', 'attachment; filename="PKB 2023-2025_SIGN.pdf"');
    }
}