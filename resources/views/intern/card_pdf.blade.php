<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <style>
        /* Standar ID Card Portrait - Sedikit di bawah ukuran A4 agar tidak lari ke 2 halaman */
        @page { margin: 0; size: 280pt 420pt; }
        body {
            margin: 0;
            padding: 0;
            font-family: 'Helvetica', sans-serif;
            background-color: #ffffff;
            width: 280pt;
            height: 420pt;
            overflow: hidden;
        }
        .card-container {
            width: 280pt;
            height: 420pt;
            position: relative;
            background-color: #ffffff;
            border: 1px solid #ddd;
        }
        .header {
            background-color: #0f172a;
            color: #ffffff;
            text-align: center;
            padding: 15pt 5pt;
            border-bottom: 2pt solid #2563eb;
        }
        .header img {
            width: 35pt;
            background: white;
            padding: 2pt;
            border-radius: 3pt;
            margin-bottom: 5pt;
        }
        .header-title {
            font-size: 14pt;
            font-weight: bold;
            margin: 0;
            line-height: 1;
        }
        .header-sub {
            font-size: 8pt;
            font-weight: bold;
            color: #60a5fa;
            letter-spacing: 0.5pt;
            margin-top: 2pt;
        }
        .content {
            text-align: center;
            padding-top: 15pt;
        }
        .photo-frame {
            width: 110pt;
            height: 145pt;
            border: 3pt solid #f1f5f9;
            display: inline-block;
            background-color: #f8fafc;
            overflow: hidden;
        }
        .photo-img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        .user-info {
            margin-top: 15pt;
            padding: 0 10pt;
        }
        .user-name {
            font-size: 16pt;
            font-weight: bold;
            color: #000;
            text-transform: uppercase;
            line-height: 1.1;
        }
        .user-nim {
            font-size: 12pt;
            font-weight: bold;
            color: #2563eb;
            margin-top: 4pt;
        }
        .user-school {
            font-size: 9pt;
            color: #64748b;
            font-weight: bold;
            text-transform: uppercase;
            margin-top: 8pt;
        }
        .qr-section {
            position: absolute;
            bottom: 25pt;
            width: 100%;
            text-align: center;
        }
        .qr-code {
            width: 55pt;
            height: 55pt;
        }
        .footer-line {
            position: absolute;
            bottom: 0;
            width: 100%;
            height: 10pt;
            background-color: #0f172a;
        }
    </style>
</head>
<body>
    @php \Carbon\Carbon::setLocale('id'); @endphp
    <div class="card-container">
        <div class="header">
            <img src="{{ public_path('logo-dinsos.jpg') }}">
            <div class="header-title">DINAS SOSIAL</div>
            <div class="header-sub">KABUPATEN LAMONGAN</div>
        </div>

        <div class="content">
            <div class="photo-frame">
                @if($photoBase64)
                    <img src="{{ $photoBase64 }}" class="photo-img">
                @else
                    <div style="padding-top: 60pt; font-size: 7pt; color: #ccc;">FOTO PESERTA</div>
                @endif
            </div>

            <div class="user-info">
                <div class="user-name">{{ $user->name }}</div>
                <div class="user-nim">{{ $user->nim }}</div>
                <div class="user-school">{{ $user->school }}</div>
            </div>
        </div>

        <div class="qr-section">
            <img src="data:image/svg+xml;base64,{{ $qrCode }}" class="qr-code">
            <div style="font-size: 5pt; color: #999; margin-top: 4pt; font-weight: bold;">DICETAK: {{ now()->translatedFormat('l, d F Y') }}</div>
        </div>

        <div class="footer-line"></div>
    </div>
</body>
</html>
