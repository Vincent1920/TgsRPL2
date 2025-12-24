<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Tugas; 
use Illuminate\Support\Facades\Mail; 
use App\Mail\ReminderTugasMail; 

class SendTaskReminders extends Command
{
    protected $signature = 'app:send-task-reminders';
    protected $description = 'Mengirimkan pengingat email 1 jam sebelum dan saat deadline';

    public function handle()
    {
        // 1. Definisikan variabel waktu
        $oneHourFromNow = now()->addHour()->format('Y-m-d H:i');
        $now = now()->format('Y-m-d H:i');

        $this->info("Mengecek pengingat untuk: " . $oneHourFromNow);
        $this->info("Mengecek deadline untuk: " . $now);

        // 2. Ambil tugas dengan pengecekan variabel yang benar
        // Hapus sementara filter WHERE tanggal untuk testing saja
        $tugasNotifikasi = Tugas::with('user')
            ->where('is_done', false)
            ->limit(1) // Ambil 1 tugas apa saja
            ->get();

        if ($tugasNotifikasi->isEmpty()) {
            $this->info("Tidak ada tugas yang cocok dengan waktu tersebut.");
            return;
        }

        foreach ($tugasNotifikasi as $tugas) {
            if ($tugas->user && $tugas->user->email) {
                try {
                    Mail::to($tugas->user->email)->send(new ReminderTugasMail($tugas));
                    
                    // Update status its_over jika sudah melewati deadline
                    if (now()->format('Y-m-d H:i') >= date('Y-m-d H:i', strtotime($tugas->tanggal))) {
                        $tugas->update(['its_over' => true]);
                    }

                    $this->info("Berhasil mengirim email ke: " . $tugas->user->email . " untuk tugas: " . $tugas->tugas);
                } catch (\Exception $e) {
                    $this->error("Gagal mengirim ke " . $tugas->user->email . ": " . $e->getMessage());
                }
            } else {
                $this->warn("Tugas ID {$tugas->id} tidak memiliki user atau email.");
            }
        }
    }
}