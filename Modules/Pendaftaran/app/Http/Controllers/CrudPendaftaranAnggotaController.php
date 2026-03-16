<?php

namespace Modules\Pendaftaran\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Mail\SendEmail;
use Illuminate\Support\Facades\Crypt;
use App\Helpers\LogActivity;
use App\Mail\VerifikasiEmail;
use Exception;
use Illuminate\Support\Str;
class CrudPendaftaranAnggotaController extends Controller
{


   public static function store(Request $request)
    {

         $uuid = Str::random(64);
    

        if($request->cek_read == 1 || $request->cek_read == "1"){
            
            $validatedData = $request->validate([
                'nama' => 'required',
                'nik' => 'required|numeric|unique:pendaftaran,nik',
                'nip' => 'required',
                'tempat_lahir' => 'required',
                'tanggal_lahir' => 'required|date',
                'alamat' => 'required',
                'no_hp' => 'required',
                'email' => 'required|email|unique:pendaftaran,email',
                'upload_id_card' => 'required|mimetypes:image/jpeg,image/png,image/jpg|max:10800',
                'upload_selfie' => 'required|mimetypes:image/jpeg,image/png,image/jpg|max:10800',
                'persetujuan_iuran' => 'required',
                'persetujuan_keaktifan'=> 'required',
                'persetujuan_ketentuan'=> 'required',
                'persetujuan_potong_gaji'=> 'required',
                'verify' => 'required',
            ], [
                'nama.required' => 'Nama wajib diisi.',
                'nik.required' => 'NIK wajib diisi.',
                'nik.numeric' => 'NIK harus berupa angka.',
                'nik.unique' => 'NIK sudah terdaftar.',
                'tempat_lahir.required' => 'Tempat lahir wajib diisi.',
                'tanggal_lahir.required' => 'Tanggal lahir wajib diisi.',
                'tanggal_lahir.date' => 'Tanggal lahir tidak valid.',
                'alamat.required' => 'Alamat wajib diisi.',
                'no_hp.required' => 'Nomor HP wajib diisi.',
                'email.required' => 'Email wajib diisi.',
                'email.email' => 'Format email tidak valid.',
                'email.unique' => 'Email sudah terdaftar.',
                'upload_id_card.required' => 'ID Card wajib diunggah.',
                'upload_id_card.mimetypes' => 'ID Card harus berupa gambar JPG/PNG.',
                'upload_id_card.max' => 'Ukuran ID Card tidak boleh lebih dari 10MB.',
                'upload_selfie.required' => 'Selfie wajib diunggah.',
                'upload_selfie.mimetypes' => 'Selfie harus berupa gambar JPG/PNG.',
                'upload_selfie.max' => 'Ukuran Selfie tidak boleh lebih dari 10MB.',
                'persetujuan_iuran.required' => 'Anda harus menyetujui iuran.',
                'persetujuan_keaktifan.required' => 'Anda harus menyetujui keaktifan.',
                'persetujuan_ketentuan.required' => 'Anda harus menyetujui ketentuan.',
                'persetujuan_potong_gaji.required' => 'Anda harus menyetujui pemotongan gaji.',
                'verify.required' => 'Anda harus menyetujui kebijakan privasi.',
            ]);
    
            
            
            $imageName = time().'-id_card.'.$request->upload_id_card->extension();
            $imageName2 = time().'-wajah.'.$request->upload_selfie->extension();
            
            $time = time();
            $data_foto = base_path('assets/'.$request->nik.'-'.$time); 
            if (!File::exists(  $data_foto)) {
                File::makeDirectory(  $data_foto, 0755, true); // Membuat folder dengan permission 0755
                $request->upload_id_card->move(base_path('assets/'.$request->nik.'-'.$time), $imageName);
                $request->upload_selfie->move(base_path( 'assets/'.$request->nik.'-'.$time), $imageName2);
            }
    
  
            DB::table('pendaftaran')->where('nip',$request->nip)->update([
                'nik'=> $request->nik,
                'nip'=> $request->nip,
                'tempat_lahir'=> $request->tempat_lahir,
                'tanggal_lahir'=> $request->tanggal_lahir,
                'alamat'=> $request->alamat,
                'no_hp'=> $request->no_hp,
                'email'=> $request->email,
                'upload_id_card'=> 'gambar/'.$request->nik.'-'.$time.'/'.$imageName,
                'upload_selfie'=>  'gambar/'.$request->nik.'-'.$time.'/'.$imageName2,
                'persetujuan_iuran'=> $request->persetujuan_iuran,
                'persetujuan_keaktifan'=> $request->persetujuan_keaktifan,
                'persetujuan_ketentuan'=> $request->persetujuan_ketentuan,
                'persetujuan_potong_gaji'=> $request->persetujuan_potong_gaji,
                'status_pendaftaran'=> 'pending',
                'tgl_pendaftaran'=> now(),
                'uuid'=> $uuid,
                'status'=> '0'
            ]);
    
            // dd($validatedData);
    
            return redirect("result-pendaftaran/". $request->email.'/'.$uuid)->with('success', 'Pendaftaran berhasil dikirim!');

        }else{


            $validatedData = $request->validate([
                'upload_id_card' => 'required|mimetypes:image/jpeg,image/png,image/jpg|max:10800',
                'upload_selfie' => 'required|mimetypes:image/jpeg,image/png,image/jpg|max:10800',
                'persetujuan_iuran' => 'required',
                'persetujuan_keaktifan'=> 'required',
                'persetujuan_ketentuan'=> 'required',
                'persetujuan_potong_gaji'=> 'required',
                'verify' => 'required',
            ], [
                'upload_id_card.required' => 'ID Card wajib diunggah.',
                'upload_id_card.mimetypes' => 'ID Card harus berupa gambar JPG/PNG.',
                'upload_id_card.max' => 'Ukuran ID Card tidak boleh lebih dari 10MB.',
                'upload_selfie.required' => 'Selfie wajib diunggah.',
                'upload_selfie.mimetypes' => 'Selfie harus berupa gambar JPG/PNG.',
                'upload_selfie.max' => 'Ukuran Selfie tidak boleh lebih dari 10MB.',
                'persetujuan_iuran.required' => 'Anda harus menyetujui iuran.',
                'persetujuan_keaktifan.required' => 'Anda harus menyetujui keaktifan.',
                'persetujuan_ketentuan.required' => 'Anda harus menyetujui ketentuan.',
                'persetujuan_potong_gaji.required' => 'Anda harus menyetujui pemotongan gaji.',
                'verify.required' => 'Anda harus menyetujui kebijakan privasi.',
            ]);
    
            
            
            $imageName = time().'-id_card.'.$request->upload_id_card->extension();
            $imageName2 = time().'-wajah.'.$request->upload_selfie->extension();
            
            $time = time();
            $data_foto = base_path('assets/'.$request->nik.'-'.$time); 
            if (!File::exists(  $data_foto)) {
                File::makeDirectory(  $data_foto, 0755, true); // Membuat folder dengan permission 0755
                $request->upload_id_card->move(base_path('assets/'.$request->nik.'-'.$time), $imageName);
                $request->upload_selfie->move(base_path( 'assets/'.$request->nik.'-'.$time), $imageName2);
            }
    
    
          DB::table('pendaftaran')->where('nip', $request->nip)->update([
                 'nama'=> $request->nama,
                'nik'=> $request->nik,
                'nip'=> $request->nip,
                'tempat_lahir'=> $request->tempat_lahir,
                'tanggal_lahir'=> $request->tanggal_lahir,
                'alamat'=> $request->alamat,
                'no_hp'=> $request->no_hp,
                'email'=> $request->email,
                'upload_id_card'=> 'gambar/'.$request->nik.'-'.$time.'/'.$imageName,
                'upload_selfie'=>  'gambar/'.$request->nik.'-'.$time.'/'.$imageName2,
                'persetujuan_iuran'=> $request->persetujuan_iuran,
                'persetujuan_keaktifan'=> $request->persetujuan_keaktifan,
                'persetujuan_ketentuan'=> $request->persetujuan_ketentuan,
                'persetujuan_potong_gaji'=> $request->persetujuan_potong_gaji,
                'status_pendaftaran'=> 'approved',
                'tgl_pendaftaran'=> now(),
                'uuid'=> $uuid,
                'status'=> '1'
            ]);

            $pdf =  DB::table('pendaftaran')->where('nip', $request->nip)->first();
            $uuid = $pdf->uuid;
            
            $eml = $request->email;
           self::send_text_email($eml, $uuid);
    
            return redirect("result-pendaftaran/". $request->email.'/'.$uuid)->with('success', 'Pendaftaran berhasil dikirim!');

        }
        
    }

    public static function send_text_email($email, $uuid){
            $link  = 'https://sppelitaair.org/registrasi-pendaftaran';
            Mail::to($email)->send(new VerifikasiEmail($link,$uuid));
             return redirect("result/".$email.'/'.$uuid)->with('success', 'Pendaftaran berhasil dikirim!');
        
    }


     
}