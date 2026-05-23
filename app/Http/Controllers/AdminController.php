<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Attendance;
use App\Models\Journal;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard()
    {
        $stats = [
            'total_interns' => User::where('role', 'intern')->count(),
            'pending' => User::where('role', 'intern')->where('status', 'pending')->count(),
            'active' => User::where('role', 'intern')->where('status', 'approved')->count(),
            'alumni' => User::where('role', 'intern')->where('status', 'finished')->count(),
        ];
        return view('admin.dashboard', compact('stats'));
    }

    public function interns()
    {
        $interns = User::where('role', 'intern')->whereIn('status', ['pending', 'approved'])->get();
        $title = "Kelola Peserta";
        return view('admin.interns', compact('interns', 'title'));
    }

    public function alumni()
    {
        $interns = User::where('role', 'intern')->where('status', 'finished')->with('evaluation')->get();
        $title = "Alumni Magang";
        return view('admin.alumni', compact('interns', 'title'));
    }

    public function approve(User $user)
    {
        $user->update(['status' => 'approved']);
        return back()->with('success', 'Peserta berhasil disetujui.');
    }

    public function reject(User $user)
    {
        $user->update(['status' => 'rejected']);
        return back()->with('success', 'Peserta ditolak.');
    }

    public function attendances()
    {
        // Group by Date
        $attendancesGrouped = Attendance::with('user')->orderBy('date', 'desc')->get()->groupBy('date');
        return view('admin.attendances', compact('attendancesGrouped'));
    }

    public function journals()
    {
        // Group by Date
        $journalsGrouped = Journal::with('user')->orderBy('date', 'desc')->get()->groupBy('date');
        return view('admin.journals', compact('journalsGrouped'));
    }

    public function evaluations()
    {
        // Show interns who are approved or finished
        $interns = User::where('role', 'intern')
            ->whereIn('status', ['approved', 'finished'])
            ->with('evaluation')
            ->get();
        return view('admin.evaluations', compact('interns'));
    }

    public function storeEvaluation(Request $request, User $user)
    {
        $request->validate([
            'kedisiplinan' => 'required|numeric|min:0|max:100',
            'tanggung_jawab' => 'required|numeric|min:0|max:100',
            'kerja_sama' => 'required|numeric|min:0|max:100',
            'kreativitas' => 'required|numeric|min:0|max:100',
            'kemampuan_beradaptasi' => 'required|numeric|min:0|max:100',
            'kualitas_hasil_kerja' => 'required|numeric|min:0|max:100',
            'penyusunan_laporan' => 'required|numeric|min:0|max:100',
            'finished_at' => 'required|date',
            'comments' => 'required|string',
        ]);

        $average = collect($request->only([
            'kedisiplinan', 'tanggung_jawab', 'kerja_sama', 
            'kreativitas', 'kemampuan_beradaptasi', 'kualitas_hasil_kerja', 
            'penyusunan_laporan'
        ]))->average();

        $predicate = 'D';
        if ($average >= 85) $predicate = 'A (Sangat Baik)';
        elseif ($average >= 70) $predicate = 'B (Baik)';
        elseif ($average >= 55) $predicate = 'C (Cukup)';

        \App\Models\Evaluation::updateOrCreate(
            ['user_id' => $user->id],
            array_merge($request->all(), [
                'average' => $average, 
                'predicate' => $predicate,
                'finished_at' => $request->finished_at
            ])
        );

        $user->update(['status' => 'finished']);

        return back()->with('success', 'Penilaian berhasil disimpan dan status peserta menjadi Selesai.');
    }

    public function messages()
    {
        $interns = User::where('role', 'intern')->whereIn('status', ['approved', 'finished'])->get();
        return view('admin.messages', compact('interns'));
    }

    public function storeMessage(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'message' => 'required|string',
            'type' => 'required|in:announcement,message',
            'user_id' => 'nullable|exists:users,id' // null means to all interns
        ]);

        $notification = new \App\Notifications\InternMessageNotification(
            $request->title,
            $request->message,
            $request->type
        );

        if ($request->type === 'announcement' || !$request->user_id) {
            // Send to all interns
            $interns = User::where('role', 'intern')->whereIn('status', ['approved', 'finished'])->get();
            \Illuminate\Support\Facades\Notification::send($interns, $notification);
            $msgType = 'Pengumuman';
        } else {
            // Send to specific intern
            $user = User::findOrFail($request->user_id);
            $user->notify($notification);
            $msgType = 'Pesan';
        }

        return back()->with('success', $msgType . ' berhasil dikirim!');
    }
}
