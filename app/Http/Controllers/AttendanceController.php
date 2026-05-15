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
            ->latest()
            ->first();

        return view('attendance.scan', compact('user', 'attendance'));
    }

    public function store(Request $request, User $user)
    {
        $request->validate([
            'status' => 'required|in:hadir,izin,sakit',
            'keterangan' => 'nullable|string',
            'action' => 'required|in:check_in,check_out',
        ]);

        $now = Carbon::now('Asia/Jakarta');
        $today = $now->toDateString();
        $currentTime = $now->toTimeString();

        // Handle Check-out (Action explicitly sent as check_out)
        if ($request->action === 'check_out') {
            $hadirRecord = Attendance::where('user_id', $user->id)
                ->where('date', $today)
                ->where('status', 'hadir')
                ->whereNull('check_out_time')
                ->latest()
                ->first();

            if ($hadirRecord) {
                if ($now->hour < 15) {
                    return back()->with('error', 'Absen pulang hanya bisa dilakukan setelah jam 15:00.');
                }
                $hadirRecord->update(['check_out_time' => $currentTime]);
                return back()->with('success', 'Berhasil absen pulang.');
            }
            return back()->with('error', 'Tidak ditemukan sesi hadir aktif untuk diabsen pulang.');
        }

        // Handle Check-in / Status Change
        $final_keterangan = $request->keterangan;
        if ($request->status === 'hadir') {
            if ($now->hour >= 9) {
                $final_keterangan = "[TERLAMBAT] " . ($request->keterangan ?? '');
            } else if ($now->hour < 7) {
                return back()->with('error', 'Absensi baru dibuka jam 07:00 pagi.');
            } else {
                $final_keterangan = "[TEPAT WAKTU] " . ($request->keterangan ?? '');
            }
        }

        // Special Rule: If SAKIT, also close any active HADIR sessions
        if ($request->status === 'sakit') {
            Attendance::where('user_id', $user->id)
                ->where('date', $today)
                ->where('status', 'hadir')
                ->whereNull('check_out_time')
                ->update(['check_out_time' => $currentTime]);
        }

        // Create new record
        Attendance::create([
            'user_id' => $user->id,
            'date' => $today,
            'check_in_time' => $currentTime,
            'status' => $request->status,
            'keterangan' => $final_keterangan,
        ]);

        return back()->with('success', 'Status ' . strtoupper($request->status) . ' berhasil diperbarui.');
    }
}
