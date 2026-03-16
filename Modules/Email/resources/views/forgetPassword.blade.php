<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Forget Password</title>
</head>
<body style="font-family: Arial, sans-serif; background-color: #f9f9f9; margin: 0; padding: 40px;">
    <table align="center" width="600" cellpadding="0" cellspacing="0" style="background-color: #fff; border-radius: 10px; padding: 40px; box-shadow: 0 0 10px rgba(0,0,0,0.05);">
        <tr>
            <td align="center" style="padding-bottom: 20px;">
                <img src="https://sppelitaair.org/template/landing/assets/img/logo-srkt.png" width="120" alt="Serikat">
            </td>
        </tr>
        <tr>
            <td align="center">
                <h2>Permintaan Atur Ulang Password</h2>
                <p style="color: #555;">
                    Kami menerima permintaan untuk mereset password Anda. Klik tombol di bawah untuk mengatur ulang password:
                </p>
                <a href="https://sppelitaair.org/reset-password/{{$token}}/{{$email}}" style="display: inline-block; margin-top: 20px; padding: 12px 30px; background-color: #ef4444; color: #fff; text-decoration: none; border-radius: 6px;">Reset Password</a>
                <p style="color: #999; font-size: 12px; margin-top: 20px;">
                    Jika Anda tidak meminta reset password, abaikan email ini.
                </p>
            </td>
        </tr>
        <tr>
            <td align="center" style="padding-top: 30px; font-size: 12px; color: #888;">
                {{ $company->address }}
            </td>
        </tr>
    </table>
</body>
</html>
