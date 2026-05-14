<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Penilaian Magang - {{ $user->name }}</title>
    <style>
        body {
            font-family: 'Helvetica', 'Arial', sans-serif;
            margin: 40px;
            color: #333;
        }
        .header {
            text-align: center;
            border-bottom: 3px solid #000;
            padding-bottom: 20px;
            margin-bottom: 30px;
        }
        .header h1 {
            margin: 0;
            font-size: 24px;
            text-transform: uppercase;
        }
        .header p {
            margin: 5px 0;
            font-size: 14px;
        }
        .info-table {
            width: 100%;
            margin-bottom: 30px;
        }
        .info-table th {
            text-align: left;
            width: 30%;
            padding: 5px 0;
        }
        .info-table td {
            padding: 5px 0;
        }
        .score-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 30px;
        }
        .score-table th, .score-table td {
            border: 1px solid #000;
            padding: 10px;
        }
        .score-table th {
            background-color: #f3f4f6;
            text-align: left;
        }
        .text-right {
            text-align: right !important;
        }
        .text-center {
            text-align: center !important;
        }
        .comments-box {
            border: 1px solid #000;
            padding: 15px;
            min-height: 80px;
            margin-bottom: 50px;
        }
        .signature {
            width: 100%;
            margin-top: 50px;
        }
        .signature td {
            width: 50%;
            text-align: center;
        }
    </style>
</head>
<body>

    <div class="header">
        <h1>LAPORAN PENILAIAN MAGANG</h1>
        <p>DINAS SOSIAL KABUPATEN LAMONGAN</p>
    </div>

    <table class="info-table">
        <tr>
            <th>Nama Lengkap</th>
            <td>: {{ $user->name }}</td>
        </tr>
        <tr>
            <th>NIM / NISN</th>
            <td>: {{ $user->nim }}</td>
        </tr>
        <tr>
            <th>Asal Sekolah / Universitas</th>
            <td>: {{ $user->school }}</td>
        </tr>
    </table>

    <table class="score-table">
        <thead>
            <tr>
                <th style="width: 50px;" class="text-center">No</th>
                <th>Kriteria Penilaian</th>
                <th style="width: 100px;" class="text-center">Nilai</th>
            </tr>
        </thead>
        <tbody>
            <tr><td class="text-center">1</td><td>Kedisiplinan</td><td class="text-center">{{ $evaluation->kedisiplinan }}</td></tr>
            <tr><td class="text-center">2</td><td>Tanggung Jawab</td><td class="text-center">{{ $evaluation->tanggung_jawab }}</td></tr>
            <tr><td class="text-center">3</td><td>Kerja Sama Tim</td><td class="text-center">{{ $evaluation->kerja_sama }}</td></tr>
            <tr><td class="text-center">4</td><td>Kreativitas</td><td class="text-center">{{ $evaluation->kreativitas }}</td></tr>
            <tr><td class="text-center">5</td><td>Kemampuan Beradaptasi</td><td class="text-center">{{ $evaluation->kemampuan_beradaptasi }}</td></tr>
            <tr><td class="text-center">6</td><td>Kualitas Hasil Kerja</td><td class="text-center">{{ $evaluation->kualitas_hasil_kerja }}</td></tr>
            <tr><td class="text-center">7</td><td>Penyusunan Laporan</td><td class="text-center">{{ $evaluation->penyusunan_laporan }}</td></tr>
            
            <tr>
                <th colspan="2" class="text-right">Rata-Rata:</th>
                <th class="text-center">{{ $evaluation->average }}</th>
            </tr>
            <tr>
                <th colspan="2" class="text-right">Predikat:</th>
                <th class="text-center">{{ $evaluation->predicate }}</th>
            </tr>
        </tbody>
    </table>

    <p style="font-weight: bold;">Komentar & Pesan Pembimbing:</p>
    <div class="comments-box">
        {{ $evaluation->comments }}
    </div>

    <table class="signature">
        <tr>
            <td></td>
            <td>
                Lamongan, {{ \Carbon\Carbon::now()->translatedFormat('d F Y') }}<br>
                Pembimbing Magang<br>
                <br><br><br><br>
                _______________________
            </td>
        </tr>
    </table>

</body>
</html>
