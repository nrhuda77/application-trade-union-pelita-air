<?php

namespace Modules\Pkb\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Mpdf\Mpdf;

class PkbAnggotaController extends Controller
{
     Public function index(){
       $cek = Auth::guard('anggota')->user();
       $data =DB::table('pdf_pkb')->where('uuid_anggota', $cek->uuid)->first();
        return view('pkb::anggota',['data'=>$data]);
    }
   public function download()
{
    $user = Auth::guard('anggota')->user();

    // cek apakah user sudah pernah download
    $existing = DB::table('pdf_pkb')->where('uuid_anggota', $user->uuid)->first();

    if ($existing) {
        // sudah pernah download → redirect dengan alert
        return redirect('/pdf-pkb')->with('error', 'Anda sudah mengunduh PDF ini. Hubungi admin jika perlu.');
    }

    $pdfPath = base_path('pkb_file/PKB 2023-2025_SIGN.pdf');

    if (!file_exists($pdfPath)) {
        return redirect('/pdf-pkb')->with('error', 'File PDF tidak ditemukan.');
    }

    try {
        $anggota = DB::table('anggota')->where('uuid', $user->uuid)->first();

        // Generate PDF
        $mpdf = new Mpdf(['tempDir' => storage_path('app/temp')]);
        $pagecount = $mpdf->setSourceFile($pdfPath);

        for ($i = 1; $i <= $pagecount; $i++) {
            $tplId = $mpdf->importPage($i);
            $mpdf->AddPage();
            $mpdf->useTemplate($tplId);

            // Watermark nama anggota
            $mpdf->SetWatermarkText('Dokumen: ' . $user->nama);
            $mpdf->showWatermarkText = true;
        }

        // Proteksi PDF
        $mpdf->SetProtection(['print'], $anggota->tanggal_lahir, $anggota->nip);

        // Simpan log download ke DB
        DB::table('pdf_pkb')->insert([
            'uuid_anggota' => $user->uuid,
            'nama_anggota' => $user->nama,
            'password' => $anggota->nip,
            'status' => '1',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Output PDF ke browser
        $pdfOutput = $mpdf->Output('', \Mpdf\Output\Destination::STRING_RETURN);

        return response($pdfOutput)
            ->header('Content-Type', 'application/pdf')
            ->header('Content-Disposition', 'attachment; filename="PKB_2023-2025_SIGN.pdf"');

    } catch (\Exception $e) {
        return redirect('/pdf-pkb')->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
    }
}

}