<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Absensi - {{ $user->name }}</title>
    <style>
        @page { margin: 30px; }
        body { font-family: 'Helvetica', 'Arial', sans-serif; margin: 0; padding: 20px; color: #1e293b; }
        .header { border-bottom: 2px solid #334155; padding-bottom: 20px; margin-bottom: 30px; }
        .header table { width: 100%; }
        .logo { height: 60px; width: auto; }
        .header-text { text-align: right; }
        .header-text h1 { margin: 0; font-size: 20px; color: #0f172a; text-transform: uppercase; }
        .header-text p { margin: 2px 0; font-size: 11px; color: #64748b; font-weight: bold; }
        
        .info-section { margin-bottom: 25px; font-size: 13px; }
        .info-section table { width: 100%; }
        .info-label { font-weight: bold; color: #64748b; width: 120px; text-transform: uppercase; font-size: 10px; }
        .info-value { font-weight: bold; color: #0f172a; }

        .table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        .table th { background-color: #f8fafc; border: 1px solid #e2e8f0; padding: 12px 8px; text-align: center; font-size: 11px; font-bold; text-transform: uppercase; color: #475569; }
        .table td { border: 1px solid #e2e8f0; padding: 10px 8px; text-align: center; font-size: 12px; color: #334155; }
        .status-badge { font-weight: bold; font-size: 10px; text-transform: uppercase; }
        
        .footer { position: fixed; bottom: 0; width: 100%; text-align: center; font-size: 10px; color: #94a3b8; padding: 20px 0; border-top: 1px solid #f1f5f9; }
    </style>
</head>
<body>
    <div class="header">
        <table>
            <tr>
                <td style="width: 70px;">
                    <img src="{{ public_path('logo-dinsos.jpg') }}" class="logo">
                </td>
                <td>
                    <div style="margin-left: 15px;">
                        <h1 style="font-size: 18px; color: #1e3a8a;">DINAS SOSIAL</h1>
                        <p style="margin: 0; font-size: 12px; color: #64748b; text-transform: uppercase; font-weight: bold; letter-spacing: 1px;">Kabupaten Lamongan</p>
                    </div>
                </td>
                <td class="header-text">
                    <h1>REKAPITULASI ABSENSI</h1>
                    <p>Periode: {{ \Carbon\Carbon::now()->translatedFormat('F Y') }}</p>
                </td>
            </tr>
        </table>
    </div>
    
    <div class="info-section">
        <table style="width: auto; min-width: 400px;">
            <tr>
                <td class="info-label" style="width: 120px;">Nama Lengkap</td>
                <td class="info-value">: {{ $user->name }}</td>
            </tr>
            <tr>
                <td class="info-label">NIM / NISN</td>
                <td class="info-value">: {{ $user->nim }}</td>
            </tr>
            <tr>
                <td class="info-label">Asal Instansi</td>
                <td class="info-value">: {{ $user->school }}</td>
            </tr>
            <tr>
                <td class="info-label">Total Hari Hadir</td>
                <td class="info-value">: {{ $attendances->count() }} Hari</td>
            </tr>
        </table>
    </div>

    <table class="table" style="width: 100%; table-layout: fixed;">
        <thead>
            <tr>
                <th style="width: 40px;">No</th>
                <th style="width: 150px;">Hari / Tanggal</th>
                <th>Masuk</th>
                <th>Pulang</th>
                <th>Status Kehadiran</th>
            </tr>
        </thead>
        <tbody>
            @php $no = 1; @endphp
            @foreach($attendances as $date => $group)
            @php 
                $minIn = $group->whereNotNull('check_in_time')->min('check_in_time');
                $maxOut = $group->whereNotNull('check_out_time')->max('check_out_time');
                
                // Priority: If any record is HADIR, show only HADIR. Otherwise show latest status.
                if ($group->where('status', 'hadir')->count() > 0) {
                    $displayStatus = 'HADIR';
                } else {
                    $displayStatus = strtoupper($group->last()->status);
                }
            @endphp
            <tr>
                <td>{{ $no++ }}</td>
                <td style="text-align: left; padding-left: 15px; font-weight: bold;">
                    {{ \Carbon\Carbon::parse($date)->translatedFormat('l, d F Y') }}
                </td>
                <td style="font-weight: bold;">{{ $minIn ?? '—' }}</td>
                <td style="font-weight: bold;">{{ $maxOut ?? '—' }}</td>
                <td>
                    <span class="status-badge">{{ $displayStatus }}</span>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="footer">
        SIMASOS (Sistem Informasi Manajemen Magang) &bull; Dinas Sosial Kabupaten Lamongan
    </div>
</body>
</html>
