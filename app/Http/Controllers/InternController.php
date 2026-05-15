<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Barryvdh\DomPDF\Facade\Pdf;

use App\Models\Attendance;
use Carbon\Carbon;

class InternController extends Controller
{
    public function dashboard()
    {
        $user = auth()->user();
        return view('intern.dashboard', compact('user'));
    }

    public function card()
    {
        return view('intern.card');
    }

    public function updatePhoto(Request $request)
    {
        $request->validate(['photo' => 'required|image|max:2048']);
        $path = $request->file('photo')->store('photos', 'public');
        
        $user = auth()->user();
        $user->photo_path = $path;
        $user->save();

        return back()->with('success', 'Foto profil berhasil diperbarui.');
    }

    public function printCard()
    {
        $user = auth()->user();
        if ($user->status !== 'approved' && $user->status !== 'finished') {
            abort(403, 'Anda belum disetujui.');
        }

        // Generate QR Code linking to automated attendance scan page
        $qrCode = base64_encode(QrCode::format('svg')->size(150)->generate(route('attendance.scan', $user)));

        // Encode photo to Base64 for PDF stability
        $photoBase64 = null;
        if ($user->photo_path && file_exists(public_path('storage/' . $user->photo_path))) {
            $type = pathinfo(public_path('storage/' . $user->photo_path), PATHINFO_EXTENSION);
            $data = file_get_contents(public_path('storage/' . $user->photo_path));
            $photoBase64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
        }

        $pdf = Pdf::loadView('intern.card_pdf', compact('user', 'qrCode', 'photoBase64'));
        return $pdf->stream('ID_Card_Magang_' . $user->nim . '.pdf');
    }

    public function attendance()
    {
        $user = auth()->user();
        if ($user->status !== 'approved') {
            return redirect()->route('intern.dashboard')->with('error', 'Akses ditolak.');
        }

        $today = Carbon::today()->toDateString();
        $attendance = Attendance::where('user_id', $user->id)->where('date', $today)->first();

        return view('intern.attendance', compact('attendance'));
    }

    public function storeAttendance(Request $request)
    {
        $user = auth()->user();
        $now = Carbon::now('Asia/Jakarta');
        $today = $now->toDateString();
        $time = $now->format('H:i:s');

        $attendance = Attendance::where('user_id', $user->id)->where('date', $today)->first();

        if ($request->type == 'check_in') {
            if ($attendance) {
                return back()->with('error', 'Anda sudah mencatat kehadiran hari ini.');
            }

            $request->validate([
                'status' => 'required|in:izin,sakit',
                'keterangan' => 'required|string|max:500',
                'keterangan_file' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:5120',
            ]);

            $filePath = null;
            if ($request->hasFile('keterangan_file')) {
                $filePath = $request->file('keterangan_file')->store('keterangan', 'public');
            }

            Attendance::create([
                'user_id' => $user->id,
                'date' => $today,
                'check_in_time' => $time,
                'status' => $request->status,
                'keterangan' => $request->keterangan,
                'keterangan_file' => $filePath,
            ]);
            return back()->with('success', 'Berhasil mencatat ' . ucfirst($request->status) . '.');
        }

        if ($request->type == 'check_out') {
            $minOut = Carbon::createFromTime(15, 0, 0, 'Asia/Jakarta');
            if ($now->lessThan($minOut)) {
                return back()->with('error', 'Belum waktunya Absen Pulang (Minimal Jam 15:00 WIB).');
            }
            if ($attendance && !$attendance->check_out_time) {
                $attendance->update(['check_out_time' => $time]);
                return back()->with('success', 'Berhasil Absen Pulang.');
            }
            return back()->with('error', 'Gagal absen pulang atau sudah absen pulang.');
        }

        return back();
    }

    public function journals()
    {
        $user = auth()->user();
        if ($user->status !== 'approved' && $user->status !== 'finished') {
            return redirect()->route('intern.dashboard')->with('error', 'Akses ditolak.');
        }

        $journals = \App\Models\Journal::where('user_id', $user->id)
                        ->orderBy('date', 'desc')
                        ->orderBy('created_at', 'desc')
                        ->get();

        return view('intern.journals', compact('journals'));
    }

    public function storeJournal(Request $request)
    {
        $request->validate([
            'activity' => 'required|string',
            'photo' => 'nullable|image|max:5120',
        ]);

        $photoPath = null;
        if ($request->hasFile('photo')) {
            $photoPath = $request->file('photo')->store('journals', 'public');
        }

        \App\Models\Journal::create([
            'user_id' => auth()->id(),
            'date' => Carbon::today()->toDateString(),
            'activity' => $request->activity,
            'photo_path' => $photoPath,
        ]);

        return back()->with('success', 'Jurnal berhasil ditambahkan.');
    }

    public function evaluation()
    {
        $user = auth()->user();
        if ($user->status !== 'finished') {
            return redirect()->route('intern.dashboard')->with('error', 'Penilaian belum tersedia.');
        }

        $evaluation = \App\Models\Evaluation::where('user_id', $user->id)->first();
        return view('intern.evaluation', compact('evaluation', 'user'));
    }

    public function printEvaluation()
    {
        $user = auth()->user();
        if ($user->status !== 'finished') {
            abort(403, 'Penilaian belum tersedia.');
        }

        $evaluation = \App\Models\Evaluation::where('user_id', $user->id)->first();
        
        $pdf = Pdf::loadView('intern.evaluation_pdf', compact('evaluation', 'user'));
        return $pdf->stream('Laporan_Nilai_Magang_' . $user->nim . '.pdf');
    }

    public function printAttendance()
    {
        $user = auth()->user();
        $attendances = \App\Models\Attendance::where('user_id', $user->id)->orderBy('date', 'asc')->get();
        $pdf = Pdf::loadView('intern.attendance_pdf', compact('attendances', 'user'));
        return $pdf->stream('Laporan_Absensi_' . $user->nim . '.pdf');
    }

    public function printJournals()
    {
        $user = auth()->user();
        $journals = \App\Models\Journal::where('user_id', $user->id)->orderBy('date', 'asc')->get();
        $pdf = Pdf::loadView('intern.journals_pdf', compact('journals', 'user'));
        return $pdf->stream('Laporan_Jurnal_' . $user->nim . '.pdf');
    }
}
