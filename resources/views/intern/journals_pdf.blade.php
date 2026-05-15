<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Jurnal - {{ $user->name }}</title>
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
        .table td { border: 1px solid #e2e8f0; padding: 12px 10px; vertical-align: top; font-size: 12px; color: #334155; line-height: 1.5; }
        
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
                    <h1>JURNAL KEGIATAN MAGANG</h1>
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
                <td class="info-label">Total Hari Aktif</td>
                <td class="info-value">: {{ $journals->count() }} Hari</td>
            </tr>
        </table>
    </div>

    <table class="table" style="width: 100%; table-layout: fixed; border-collapse: collapse;">
        <thead>
            <tr>
                <th style="width: 8%;">No</th>
                <th style="width: 22%;">Hari / Tanggal</th>
                <th style="text-align: left; width: 70%;">Deskripsi Aktivitas / Kegiatan</th>
            </tr>
        </thead>
        <tbody>
            @php $no = 1; @endphp
            @foreach($journals as $date => $group)
            <tr>
                <td style="text-align: center; vertical-align: top;">{{ $no++ }}</td>
                <td style="text-align: center; font-weight: bold; font-size: 10px; vertical-align: top;">
                    {{ \Carbon\Carbon::parse($date)->translatedFormat('l, d F Y') }}
                </td>
                <td style="text-align: justify; line-height: 1.5; vertical-align: top; word-wrap: break-word;">
                    @if($group->count() > 1)
                        <table style="width: 100%; border: none; border-collapse: collapse;">
                            @foreach($group as $item)
                            <tr>
                                <td style="width: 1%; white-space: nowrap; border: none; vertical-align: top; padding: 0; padding-right: 5px; padding-bottom: 8px;">
                                    <strong>{{ $loop->iteration }}.</strong>
                                </td>
                                <td style="border: none; vertical-align: top; padding: 0; padding-bottom: 8px; text-align: justify; word-wrap: break-word; word-break: break-all;">
                                    {!! nl2br(e($item->activity)) !!}
                                </td>
                            </tr>
                            @endforeach
                        </table>
                    @else
                        <div style="word-wrap: break-word; word-break: break-all; text-align: justify;">
                            {!! nl2br(e($group->first()->activity)) !!}
                        </div>
                    @endif
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
