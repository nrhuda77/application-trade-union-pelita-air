<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Verifikasi Email</title>
</head>
<body style="font-family: Arial, sans-serif; background-color: #f9f9f9; margin: 0; padding: 40px;">
    <table align="center" width="600" cellpadding="0" cellspacing="0" style="background-color: #fff; border-radius: 10px; padding: 40px; box-shadow: 0 0 10px rgba(0,0,0,0.05);">
        <tr>
            <td align="center" style="padding-bottom: 20px;">
                {{-- <img src="{{ url('template/landing/assets/img/logo-srkt.png') }}" width="120" alt="Serikat"> --}}
                <img src="https://sppelitaair.org/template/landing/assets/img/logo-srkt.png" width="120" alt="Serikat">
            </td>
        </tr>
        <tr>
            <td align="center">
                <h2>Konfirmasi alamat email Anda</h2>
                <p style="color: #555;">Terima kasih telah mendaftar. Silahkan melanjutkan :</p>
 
                <a href="{{$link}}/{{$uuid}}" style="display: inline-block; margin-top: 20px; padding: 12px 30px; background-color: #3b82f6; color: #fff; text-decoration: none; border-radius: 6px;">Verifikasi email</a>
            </td>
        </tr>
        <tr>
            <td align="center" style="padding-top: 30px; font-size: 12px; color: #888;">
                Jika Anda tidak merasa mendaftar, abaikan email ini.
                <br><br>
               {{ $company->address}}
            </td>
        </tr>
    </table>
</body>
</html>
