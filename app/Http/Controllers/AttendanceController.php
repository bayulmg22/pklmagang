<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Attendance;
use Illuminate\Http\Request;
use Carbon\Carbon;

class AttendanceController extends Controller
{
    public function scan(User $user)
    {
        $today = Carbon::today()->toDateString();
        $attendance = Attendance::where('user_id', $user->id)
            ->where('date', $today)
            ->first();

        return view('attendance.scan', compact('user', 'attendance'));
    }

    public function store(Request $request, User $user)
    {
        $request->validate([
            'status' => 'required|in:hadir,izin,sakit',
            'keterangan' => 'nullable|string',
        ]);

        $now = Carbon::now('Asia/Jakarta');
        $today = $now->toDateString();
        $currentTime = $now->toTimeString();

        $attendance = Attendance::where('user_id', $user->id)
            ->where('date', $today)
            ->first();

        // Handle Check-out
        if ($attendance && $attendance->check_in_time && !$attendance->check_out_time) {
            if ($now->hour < 15) {
                return back()->with('error', 'Absen pulang hanya bisa dilakukan setelah jam 15:00.');
            }

            $attendance->update([
                'check_out_time' => $currentTime,
            ]);

            return back()->with('success', 'Berhasil absen pulang.');
        }

        // Handle Check-in
        if ($attendance) {
            return back()->with('error', 'Anda sudah melakukan absensi hari ini.');
        }

        // Logic for Late Arrival (Only for 'hadir')
        $final_keterangan = $request->keterangan;
        if ($request->status === 'hadir') {
            if ($now->hour >= 9) {
                if (!$request->keterangan) {
                    return back()->with('error', 'Anda terlambat! Harap masukkan alasan/deskripsi keterlambatan.');
                }
                $final_keterangan = "[TERLAMBAT] " . $request->keterangan;
            } else if ($now->hour < 7) {
                return back()->with('error', 'Absensi baru dibuka jam 07:00 pagi.');
            } else {
                $final_keterangan = "[TEPAT WAKTU] " . ($request->keterangan ?? '');
            }
        }

        Attendance::create([
            'user_id' => $user->id,
            'date' => $today,
            'check_in_time' => $currentTime,
            'status' => $request->status,
            'keterangan' => $final_keterangan,
        ]);

        return back()->with('success', 'Presensi ' . strtoupper($request->status) . ' berhasil dicatat.');
    }
}
