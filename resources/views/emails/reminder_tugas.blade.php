<!DOCTYPE html>
<html>
<head>
    <title>RememberME - Pengingat Tugas</title>
</head>
<body style="font-family: sans-serif; background-color: #f4f4f4; padding: 20px;">
    <div style="background-color: #ffffff; padding: 30px; border-radius: 20px; box-shadow: 0 4px 6px rgba(0,0,0,0.1);">
        <h1 style="color: #1d4ed8;">Halo, {{ $tugas->user->name }}!</h1>
        <p>Ini adalah pengingat untuk tugas Anda:</p>
        
        <div style="background-color: #eff6ff; padding: 20px; border-radius: 15px; margin: 20px 0;">
            <h2 style="margin: 0; color: #1e40af;">{{ $tugas->tugas }}</h2>
            <p style="margin: 5px 0;"><b>Deadline:</b> {{ $tugas->tanggal }}</p>
        </div>

        <p>Ayo segera selesaikan tugasmu agar tidak menumpuk!</p>
        <p>Salam,<br><strong>RememberME Team</strong></p>
    </div>
</body>
</html>