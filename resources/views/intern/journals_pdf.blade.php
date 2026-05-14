<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Jurnal - {{ $user->name }}</title>
    <style>
        body { font-family: 'Helvetica', sans-serif; margin: 40px; color: #333; }
        .header { text-align: center; border-bottom: 2px solid #000; padding-bottom: 20px; margin-bottom: 20px; }
        .header h1 { margin: 0; font-size: 20px; text-transform: uppercase; }
        .table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        .table th, .table td { border: 1px solid #000; padding: 8px; vertical-align: top; }
        .table th { background-color: #f3f4f6; text-align: center; }
    </style>
</head>
<body>
    <div class="header">
        <h1>LAPORAN JURNAL KEGIATAN MAGANG</h1>
        <p>DINAS SOSIAL KABUPATEN LAMONGAN</p>
    </div>
    
    <p><strong>Nama:</strong> {{ $user->name }} &nbsp;&nbsp;&nbsp; <strong>NIM:</strong> {{ $user->nim }}</p>

    <table class="table">
        <thead>
            <tr>
                <th style="width: 5%;">No</th>
                <th style="width: 20%;">Tanggal</th>
                <th style="width: 75%;">Aktivitas / Kegiatan</th>
            </tr>
        </thead>
        <tbody>
            @foreach($journals as $index => $journal)
            <tr>
                <td style="text-align: center;">{{ $index + 1 }}</td>
                <td style="text-align: center;">{{ \Carbon\Carbon::parse($journal->date)->translatedFormat('d M Y') }}</td>
                <td style="white-space: pre-wrap;">{{ $journal->activity }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
