<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Penilaian Magang - {{ $user->name }}</title>
    <style>
        @page { margin: 0; }
        body { font-family: 'Helvetica', 'Arial', sans-serif; margin: 0; padding: 40px; color: #1e293b; line-height: 1.5; }
        .border-frame { border: 15px solid #f1f5f9; height: 95%; position: relative; padding: 40px; }
        
        .header { text-align: center; margin-bottom: 40px; }
        .logo { height: 70px; width: auto; margin-bottom: 15px; }
        .header h1 { margin: 0; font-size: 24px; color: #0f172a; text-transform: uppercase; letter-spacing: 2px; }
        .header p { margin: 5px 0; font-size: 12px; color: #64748b; font-weight: bold; text-transform: uppercase; letter-spacing: 3px; }
        .separator { width: 80px; height: 3px; background-color: #2563eb; margin: 20px auto; border-radius: 50px; }

        .title-section { text-align: center; margin-bottom: 30px; }
        .title-section h2 { font-size: 18px; color: #1e40af; text-transform: uppercase; margin: 0; }

        .info-table { width: 100%; margin-bottom: 30px; border-collapse: collapse; }
        .info-table th { text-align: left; width: 30%; padding: 8px 0; font-size: 11px; text-transform: uppercase; color: #64748b; }
        .info-table td { padding: 8px 0; font-size: 13px; font-weight: bold; color: #0f172a; border-bottom: 1px solid #f1f5f9; }

        .score-table { width: 100%; border-collapse: collapse; margin-bottom: 30px; border: 1px solid #e2e8f0; }
        .score-table th { background-color: #f8fafc; border: 1px solid #e2e8f0; padding: 12px; text-align: left; font-size: 10px; font-bold; text-transform: uppercase; color: #475569; }
        .score-table td { border: 1px solid #e2e8f0; padding: 10px 12px; font-size: 12px; color: #334155; }
        .text-center { text-align: center !important; }
        .text-right { text-align: right !important; }

        .summary-box { background-color: #1e3a8a; color: #ffffff; padding: 20px; border-radius: 12px; margin-bottom: 30px; }
        .summary-box table { width: 100%; }
        .summary-label { font-size: 10px; text-transform: uppercase; letter-spacing: 1px; color: #bfdbfe; }
        .summary-value { font-size: 24px; font-weight: bold; }

        .comments-section { margin-bottom: 40px; }
        .comments-section h4 { font-size: 10px; text-transform: uppercase; color: #64748b; margin-bottom: 10px; }
        .comments-box { background-color: #f8fafc; border-left: 4px solid #2563eb; padding: 15px; font-size: 12px; color: #1e293b; font-style: italic; }

        .signature { width: 100%; margin-top: 50px; }
        .signature-cell { width: 50%; text-align: center; font-size: 12px; }
    </style>
</head>
<body>
    <div class="border-frame">
        <div class="header">
            <img src="{{ public_path('logo-dinsos.jpg') }}" class="logo">
            <h1>DINAS SOSIAL</h1>
            <p>Kabupaten Lamongan</p>
            <div class="separator"></div>
        </div>

        <div class="title-section">
            <h2>Laporan Penilaian Kinerja Magang</h2>
        </div>

        <table class="info-table">
            <tr>
                <th>Nama Peserta</th>
                <td style="text-transform: uppercase;">{{ $user->name }}</td>
            </tr>
            <tr>
                <th>Nomor Induk (NIM/NISN)</th>
                <td>{{ $user->nim }}</td>
            </tr>
            <tr>
                <th>Asal Instansi</th>
                <td style="text-transform: uppercase;">{{ $user->school }}</td>
            </tr>
        </table>

        <table class="score-table">
            <thead>
                <tr>
                    <th style="width: 40px;" class="text-center">No</th>
                    <th>Kompetensi Penilaian</th>
                    <th style="width: 80px;" class="text-center">Skor</th>
                </tr>
            </thead>
            <tbody>
                <tr><td class="text-center">1</td><td>Kedisiplinan</td><td class="text-center"><strong>{{ $evaluation->kedisiplinan }}</strong></td></tr>
                <tr><td class="text-center">2</td><td>Tanggung Jawab</td><td class="text-center"><strong>{{ $evaluation->tanggung_jawab }}</strong></td></tr>
                <tr><td class="text-center">3</td><td>Kerja Sama Tim</td><td class="text-center"><strong>{{ $evaluation->kerja_sama }}</strong></td></tr>
                <tr><td class="text-center">4</td><td>Kreativitas</td><td class="text-center"><strong>{{ $evaluation->kreativitas }}</strong></td></tr>
                <tr><td class="text-center">5</td><td>Kemampuan Beradaptasi</td><td class="text-center"><strong>{{ $evaluation->kemampuan_beradaptasi }}</strong></td></tr>
                <tr><td class="text-center">6</td><td>Kualitas Hasil Kerja</td><td class="text-center"><strong>{{ $evaluation->kualitas_hasil_kerja }}</strong></td></tr>
                <tr><td class="text-center">7</td><td>Penyusunan Laporan Akhir</td><td class="text-center"><strong>{{ $evaluation->penyusunan_laporan }}</strong></td></tr>
            </tbody>
        </table>

        <div class="summary-box">
            <table>
                <tr>
                    <td>
                        <div class="summary-label">Skor Rata-rata</div>
                        <div class="summary-value">{{ number_format($evaluation->average, 1) }}</div>
                    </td>
                    <td style="text-align: right;">
                        <div class="summary-label">Predikat Kelulusan</div>
                        <div class="summary-value" style="color: #60a5fa;">{{ $evaluation->predicate }}</div>
                    </td>
                </tr>
            </table>
        </div>

        <div class="comments-section">
            <h4>Catatan Pembimbing</h4>
            <div class="comments-box">
                "{{ $evaluation->comments }}"
            </div>
        </div>

        <table class="signature">
            <tr>
                <td class="signature-cell"></td>
                <td class="signature-cell">
                    Lamongan, {{ \Carbon\Carbon::now()->translatedFormat('d F Y') }}<br>
                    <strong>Pembimbing Magang</strong><br>
                    <br><br><br><br>
                    <strong>( _______________________ )</strong>
                </td>
            </tr>
        </table>
    </div>
</body>
</html>
