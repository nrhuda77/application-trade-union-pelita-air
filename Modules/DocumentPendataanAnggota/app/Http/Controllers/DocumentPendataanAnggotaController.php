<?php

namespace Modules\DocumentPendataanAnggota\Http\Controllers;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use FPDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DocumentPendataanAnggotaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
         $nama = DB::table('anggota')->get();
         return view('documentpendataananggota::index',[
            'anggota' => $nama
        ]);
        
    }

 
    public function get(Request $request)
    {
        $data = DB::table('anggota')->where('uuid', $request->uuid)->first();

        $pdf = new FPDF();

        $pdf->AddPage();
        $pdf->Image(public_path('kop.png'), 7, 6, 195);

        $pdf->SetFont('Arial', 'B', 13);
        $pdf->SetXY($pdf->GetX(), $pdf->GetY() + 31);
        $pdf->Cell(0, 5, 'Formulir Pendataan Anggota Serikat', 0, 1, 'C');
        $pdf->Cell(0, 7, 'Pekerja Pelita Air Service', 0, 1, 'C');

        $pdf->SetFont('Arial', '', 10);
        $pdf->SetXY($pdf->GetX(), $pdf->GetY() + 7);
        $pdf->Cell(0, 5, 'Kepada :', 0, 1, 'L');
        $pdf->Cell(0, 5, 'Yth. Pimpinan Serikat Pekerja Pelita Air Service ', 0, 1, 'L');
        $pdf->Cell(0, 5, 'Ditempat ', 0, 1, 'L');

        $relativePath = ltrim($data->upload_selfie, '/');             // buang slash depan kalau ada
$relativePath = preg_replace('#^gambar/#', '', $relativePath); // hapus "gambar/" di awal
$path = base_path("assets/" . $relativePath);

         // /var/www/.../assets/selfie/user1.png
        
        $pdf->Image($path, $pdf->GetX()+143, $pdf->GetY()-17, 37, 37);
        $pdf->SetXY($pdf->GetX(), $pdf->GetY() + 15);
        $pdf->Cell(0, 7, 'Yang bertanda tangan di bawah ini Saya :', 0, 1, 'L');
        $pdf->Cell(0, 7, 'Nama ', 0, 1, 'L');
        $pdf->Cell(0, 7, 'Tempat, Tanggal Lahir ', 0, 1, 'L');
        $pdf->Cell(0, 7, 'Nomor Induk Pekerja ', 0, 1, 'L');
        $pdf->Cell(0, 7, 'Unit Kerja ', 0, 1, 'L');
        $pdf->Cell(0, 7, 'Alamat ', 0, 1, 'L');
        $pdf->Cell(0, 7, 'Nomor Telepon ', 0, 1, 'L');
        $pdf->Cell(0, 7, 'Email ', 0, 1, 'L');

        $pdf->SetXY($pdf->GetX() + 62.5, $pdf->GetY() - 49);
        $pdf->Cell(0, 7, '  : '.$data->nama, 0, 1, 'L');
        $pdf->SetXY($pdf->GetX() + 62.5, $pdf->GetY());
        $pdf->Cell(0, 7, '  : '.$data->tempat_lahir.', '.Carbon::parse($data->tanggal_lahir)->format('d F Y'), 0, 1, 'L');
        $pdf->SetXY($pdf->GetX() + 62.5, $pdf->GetY());
        $pdf->Cell(0, 7, '  : '.$data->nip, 0, 1, 'L');
        $pdf->SetXY($pdf->GetX() + 62.5, $pdf->GetY());
        $pdf->Cell(0, 7, '  : Admin', 0, 1, 'L');
        $pdf->SetXY($pdf->GetX() + 62.5, $pdf->GetY());
        $pdf->Cell(0, 7, '  : '.$data->alamat, 0, 1, 'L');
        $pdf->SetXY($pdf->GetX() + 62.5, $pdf->GetY());
        $pdf->Cell(0, 7, '  : '. $data->no_hp, 0, 1, 'L');
        $pdf->SetXY($pdf->GetX() + 62.5, $pdf->GetY());
        $pdf->Cell(0, 7, '  : '. $data->email, 0, 1, 'L');


        $pdf->SetXY($pdf->GetX(), $pdf->GetY()+15);
        $pdf->Cell(0, 5, 'Dengan ini saya mengajukan permohon untuk menjadi anggota serikat pekerja pelita air service PT PELITA AIR', 0, 1, 'L');
        $pdf->Cell(0, 5, 'SERVICE INDONESIA tanpa paksaan dari pihak manapun dan saya bersedia mematuhi ketentuan / keputusan organisasi', 0, 1, 'L');
        $pdf->Cell(0, 5, 'organisasi antara lain :', 0, 1, 'L');
        $pdf->Ln(2);
        $pdf->SetXY($pdf->GetX()+9, $pdf->GetY());
        $pdf->Cell(0, 5, '1. AD / ART SPPAS', 0, 1, 'L');
        $pdf->SetXY($pdf->GetX()+9, $pdf->GetY());
        $pdf->Cell(0, 5, '2. Membayar Iuran Anggota', 0, 1, 'L');
        $pdf->SetXY($pdf->GetX()+9, $pdf->GetY());
        $pdf->Cell(0, 5, '3. Keputusan Organisasi', 0, 1, 'L');
        $pdf->SetXY($pdf->GetX()+9, $pdf->GetY());
        $pdf->Cell(0, 5, '4. Ketentuan Organisasi', 0, 1, 'L');

        $pdf->Text(20, 240, 'Mengetahui');
        $pdf->Text(20, 245, 'Ketua Serikat Pekerja Pelita Air Service');

        $pdf->Image(public_path('barcode.png'), 20, 250, 23, 23);

        $pdf->Text(20, 280, '(...........................................)');
        

        

        $pdf->Text(143, 240, 'Pemohon ');
        $pdf->Text(143, 245, 'Balikpapan 07 Desember 2025');

        $pdf->Image(public_path('barcode.png'), 143, 250, 23, 23);

        $pdf->Text(143, 280, '(...........................................)');


        // Output langsung ke browser
        $pdf->Output('I', 'laporan.pdf'); // 'I' = inline view, 'D' = download
exit;
    }

   
}