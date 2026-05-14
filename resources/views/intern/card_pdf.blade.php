<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <style>
        @page { margin: 0px; size: 85mm 135mm; }
        body {
            font-family: 'Helvetica', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f8fafc;
        }
        .card {
            width: 85mm;
            height: 135mm;
            background: #ffffff;
            border: 1px solid #e2e8f0;
            position: relative;
            overflow: hidden;
        }
        .header {
            background-color: #1e293b;
            color: #ffffff;
            text-align: center;
            padding: 15px 10px;
            border-bottom: 4px solid #2563eb;
        }
        .logo-img {
            width: 40px;
            height: auto;
            margin-bottom: 5px;
            background: #ffffff;
            padding: 2px;
            border-radius: 4px;
        }
        .header-title {
            font-size: 14pt;
            font-weight: bold;
            margin: 0;
            letter-spacing: 1px;
        }
        .header-sub {
            font-size: 8pt;
            font-weight: bold;
            color: #94a3b8;
            margin: 2px 0 0;
            letter-spacing: 2px;
        }
        .photo-container {
            text-align: center;
            margin-top: 25px;
        }
        .photo-box {
            width: 35mm;
            height: 45mm;
            border: 3px solid #ffffff;
            display: inline-block;
            background: #f1f5f9;
        }
        .info-container {
            text-align: center;
            margin-top: 20px;
            padding: 0 20px;
        }
        .name {
            font-size: 14pt;
            font-weight: bold;
            color: #0f172a;
            text-transform: uppercase;
            margin: 0;
        }
        .nim {
            font-size: 11pt;
            color: #2563eb;
            font-weight: bold;
            margin: 5px 0;
        }
        .divider {
            width: 40px;
            height: 3px;
            background: #2563eb;
            margin: 10px auto;
        }
        .school {
            font-size: 9pt;
            color: #64748b;
            font-weight: bold;
            text-transform: uppercase;
        }
        .role-badge {
            font-size: 7pt;
            color: #94a3b8;
            font-weight: bold;
            text-transform: uppercase;
            margin-top: 5px;
            letter-spacing: 1px;
        }
        .qr-container {
            position: absolute;
            bottom: 30px;
            width: 100%;
            text-align: center;
        }
        .qr-img {
            width: 60px;
            height: 60px;
        }
        .qr-text {
            font-size: 6pt;
            color: #cbd5e1;
            font-weight: bold;
            margin-top: 5px;
            letter-spacing: 2px;
        }
        .footer-bar {
            position: absolute;
            bottom: 0;
            width: 100%;
            height: 15px;
            background: #0f172a;
        }
    </style>
</head>
<body>
    <div class="card">
        <div class="header">
            <img src="{{ public_path('logo-dinsos.jpg') }}" class="logo-img">
            <div class="header-title">DINAS SOSIAL</div>
            <div class="header-sub">KABUPATEN LAMONGAN</div>
        </div>

        <div class="photo-container">
            @if($user->photo_path)
                <img src="{{ public_path('storage/' . $user->photo_path) }}" class="photo-box">
            @else
                <div class="photo-box"></div>
            @endif
        </div>

        <div class="info-container">
            <div class="name">{{ $user->name }}</div>
            <div class="nim">{{ $user->nim }}</div>
            <div class="divider"></div>
            <div class="school">{{ $user->school }}</div>
            <div class="role-badge">PESERTA MAGANG</div>
        </div>

        <div class="qr-container">
            <img src="data:image/svg+xml;base64,{{ $qrCode }}" class="qr-img">
            <div class="qr-text">SIMASOS DIGITAL ID</div>
        </div>

        <div class="footer-bar"></div>
    </div>
</body>
</html>
