<?php

namespace Modules\LoginAnggota\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Anggota;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str; 
use Illuminate\Support\Facades\Mail;
use App\Mail\ForgetPassword;
use Illuminate\Support\Facades\Cache;

class LoginAnggotaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('loginanggota::index');
    }

   public function register(Request $request,$uuid){
        $anggota = Anggota::where("uuid",$uuid)->first();

        if($anggota?->uuid == null){
            return view("loginanggota::registrasi",[
                "uuid" => $uuid
            ]);
        }else{
            return redirect('/login');
        }
      
    }

    public function auth(Request $request)
{
    // Validasi input
    $validated = $request->validate([
        'username' => 'required',
        'password' => 'required',
    ]);

    // // Mengambil nilai 'username' dan 'password' secara langsung dari input yang sudah divalidasi
    // $credentials = [
    //     'username' => $validated['username'],
    //     'password' => $validated['password'],
    // ];

    // // Cek apakah login berhasil menggunakan guard 'anggota'
    // if (Auth::guard('anggota')->attempt($credentials)) {
    //     // Jika berhasil, perbarui session
    //     $request->session()->regenerate();

    //     // Redirect ke halaman dashboard setelah login berhasil
    //     return redirect()->intended('/dashboard');
    // } else {
    //     // Jika login gagal, kembalikan dengan pesan error
    //     return back()->with('loginFailed', 'Login Failed!');
    // }
      $login = $validated['username'];
      $password = $validated['password'];
    
     // Coba cari user berdasarkan email atau nip
    $user = \App\Models\Anggota::where('email', $login)
             ->orWhere('nip', $login)
             ->first();

    // Jika user ditemukan dan password cocok
    if ($user && Hash::check($password, $user->password)) {
        // Login manual menggunakan guard 'anggota'
        Auth::guard('anggota')->login($user);

        // Regenerasi session
        $request->session()->regenerate();

        return redirect()->intended('/dashboard-user');
    }


    // Jika gagal
    return back()->with('loginFailed', 'Login Failed!');
}


public function verif_email_forgot_password(Request $request){
           $company = DB::table('company_profiles')->first();
        return view("loginanggota::forget.verifikasi",compact('company'));
    }
    
      public function send_verif_email_forgot_password(Request $request){
          
        $token = Str::random(40);
       Cache::put('verif_token_' . $token, true, now()->addMinutes(5));
           
        Mail::to($request->email)->send(new ForgetPassword($token,$request->email));
        
             return view("email::successEmail",[
          'token' => $token,
          'email' => $request->email
            ]);
    }
    
      public function reset_password($token, $email){
          
          return view("loginanggota::forget.reset_password",[
          'token' => $token,
          'email' => $email
            ]);
      }

         public function update_new_password(Request $request){
          
            $email = $request->email;
            
            Anggota::where('email', $email)->update([
                'password' => bcrypt($request->password)
                ]);
                return view("email::successChangePassword");
      }

    public function store(Request $request){
        $validatedData = $request->validate([
            'password' => 'required',
        ],[
            'password.required'=> 'Password wajib diisi',
        ]);

        $pendaftar = DB::table('pendaftaran')->where('uuid', $request->uuid)->first();

       
        Anggota::create([
            'uuid' => $request->uuid,
            'nama' => $pendaftar->nama,
            'nik' => $pendaftar->nik,
            'nip' => $pendaftar->nip,
            'tempat_lahir' => $pendaftar->tempat_lahir,
            'username' => '-',
            'password'=> bcrypt($request->password),
            'tanggal_lahir' => $pendaftar->tanggal_lahir,
            'upload_id_card' => $pendaftar->upload_id_card,
            'upload_selfie' => $pendaftar->upload_selfie,
            'alamat' => $pendaftar->alamat,
            'no_hp' => $pendaftar->no_hp,
            'email' => $pendaftar->email,
            'jabatan'=> '-',
            'status' => 'aktif'
        ]);

        $data = Anggota::where('uuid', $request->uuid)->first();

        DB::table('pendaftaran')->where('uuid', $request->uuid)->update([
            'anggota_id' => $data->id,
        ]);

        return redirect()->route('login');
    }

    public function logout(Request $request){
        Auth::guard('anggota')->logout();
        Auth::logout();
        Session::flush();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');

    }
}