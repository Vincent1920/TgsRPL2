<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Mail;
use App\Mail\ReminderTugasMail;
use App\Models\Tugas;
// Route::get('/', function () {
//     return view('welcome');
// });
// Route::get('/{any}', fn() => view('welcome'))->where('any', '.*');

// Fallback route untuk SPA - menangani semua route Vue Router
Route::fallback(function () {
    return view('welcome');
});

Route::get('/cek-session', function () {
    return session()->all();
});

Route::get('/test-email', function () {
    $tugas = Tugas::first(); // Ambil satu contoh tugas dari DB
    Mail::to('email_tujuan_anda@gmail.com')->send(new ReminderTugasMail($tugas));
    return "Email berhasil dikirim!";
});


Route::get('/cek-smtp', function () {
    try {
        Mail::raw('Halo, ini tes koneksi SMTP RememberME!', function ($message) {
            $message->to('vincentluhulima6010@gmail.com') // Ganti dengan email Anda
                    ->subject('Tes SMTP');
        });
        return "Berhasil Terkirim!";
    } catch (\Exception $e) {
        return "Gagal: " . $e->getMessage();
    }
});