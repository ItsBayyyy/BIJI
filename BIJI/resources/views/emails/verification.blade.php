<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verifikasi Akun</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap">
</head>

<body style="background-color: #f3f4f6; font-family: 'Poppins', Arial, sans-serif; margin: 0; padding: 0; width: 100%; height: 100vh; display: flex; align-items: center; justify-content: center;">
    <div style="background-color: #ffffff; padding: 2rem; border-radius: 0.5rem; box-shadow: 0px 4px 12px rgba(0, 0, 0, 0.1); max-width: 28rem; text-align: center; margin: auto;">
        <img src="https://i.ibb.co.com/M2Fr2VY/icon.png" alt="tes" style="width: 6rem; height: 6rem; margin: 0 auto; border-radius: 50%; margin-bottom: 1rem; box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);" />
        
        <h1 style="font-size: 1.5rem; font-weight: 600; color: #1f2937; margin-bottom: 0.5rem;">
            Halo, {{ $user->username }}
        </h1>

        <p style="color: #4b5563; margin-bottom: 1rem;">
            Terima kasih telah mendaftar! Silakan verifikasi akun Anda dengan mengklik tombol di bawah ini:
        </p>

        <a href="{{ url('/activate/' . $token) }}" style="display: inline-block; background-color: #3b82f6; color: #ffffff; font-weight: 600; padding: 0.5rem 1rem; border-radius: 0.5rem; text-decoration: none; transition: background-color 0.3s ease;">
            Verifikasi Akun
        </a>

        <p style="color: #6b7280; margin: 1rem 0;">
            Atau verifikasi menggunakan tautan berikut:
        </p>

        <a href="{{ url('/activate/' . $token) }}" style="color: #3b82f6; text-decoration: underline; word-break: break-all;">{{ url('/activate/' . $token) }}</a>

        <div style="border-top: 1px solid #e5e7eb; margin-top: 1.5rem; padding-top: 1rem;">
            <p style="color: #4b5563; margin-bottom: 0.25rem;">Butuh Bantuan?</p>
            <p style="font-size: 0.875rem; color: #6b7280; margin-bottom: 1rem;">
                Jika Anda memiliki pertanyaan atau mengalami kesulitan, silakan kirimkan masukan atau informasi ke
                <a href="mailto:biji@service.id" style="color: #3b82f6; text-decoration: underline;">biji@service.id</a>.
            </p>
            <p style="font-size: 0.75rem; color: #9ca3af;">&copy; 2024 - BIJI. All rights reserved.</p>
        </div>
    </div>
</body>

</html>
