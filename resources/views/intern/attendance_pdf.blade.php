<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Absensi - {{ $user->name }}</title>
    <style>
        body { font-family: 'Helvetica', sans-serif; margin: 40px; color: #333; }
        .header { text-align: center; border-bottom: 2px solid #000; padding-bottom: 20px; margin-bottom: 20px; }
        .header h1 { margin: 0; font-size: 20px; text-transform: uppercase; }
        .table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        .table th, .table td { border: 1px solid #000; padding: 8px; text-align: center; }
        .table th { background-color: #f3f4f6; }
    </style>
</head>
<body>
    <div class="header">
        <h1>LAPORAN ABSENSI MAGANG</h1>
        <p>DINAS SOSIAL KABUPATEN LAMONGAN</p>
    </div>
    
    <p><strong>Nama:</strong> {{ $user->name }} &nbsp;&nbsp;&nbsp; <strong>NIM:</strong> {{ $user->nim }}</p>

    <table class="table">
        <thead>
            <tr>
                <th>No</th>
                <th>Tanggal</th>
                <th>Jam Masuk</th>
                <th>Jam Pulang</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach($attendances as $index => $att)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ \Carbon\Carbon::parse($att->date)->translatedFormat('d M Y') }}</td>
                <td>{{ $att->check_in_time ?? '-' }}</td>
                <td>{{ $att->check_out_time ?? '-' }}</td>
                <td>{{ ucfirst($att->status) }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
