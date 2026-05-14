<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <style>
        @page { margin: 0; size: 240pt 380pt; }
        body {
            margin: 0;
            padding: 0;
            font-family: 'Helvetica', sans-serif;
            background-color: #ffffff;
        }
        .card-wrapper {
            width: 240pt;
            height: 380pt;
            border: 1px solid #000;
            position: relative;
            overflow: hidden;
            background: #fff;
        }
        .blue-header {
            background-color: #1e3a8a;
            color: #ffffff;
            text-align: center;
            padding: 15pt 0;
        }
        .logo-box {
            background: #fff;
            padding: 2pt;
            display: inline-block;
            border-radius: 3pt;
            margin-bottom: 5pt;
        }
        .logo-img {
            height: 30pt;
            width: auto;
        }
        .title-top {
            font-size: 14pt;
            font-weight: bold;
            margin: 0;
        }
        .title-bottom {
            font-size: 8pt;
            font-weight: bold;
            color: #93c5fd;
            letter-spacing: 1pt;
        }
        .photo-section {
            text-align: center;
            margin-top: 20pt;
        }
        .photo-img {
            width: 100pt;
            height: 130pt;
            border: 3pt solid #eee;
            background-color: #f3f4f6;
        }
        .info-section {
            text-align: center;
            margin-top: 15pt;
            padding: 0 10pt;
        }
        .name-txt {
            font-size: 15pt;
            font-weight: bold;
            color: #111;
            text-transform: uppercase;
        }
        .nim-txt {
            font-size: 11pt;
            color: #1d4ed8;
            font-weight: bold;
            margin-top: 2pt;
        }
        .school-txt {
            font-size: 9pt;
            color: #444;
            font-weight: bold;
            margin-top: 8pt;
            text-transform: uppercase;
        }
        .qr-section {
            position: absolute;
            bottom: 25pt;
            width: 100%;
            text-align: center;
        }
        .qr-img {
            width: 60pt;
            height: 60pt;
        }
        .footer-strip {
            position: absolute;
            bottom: 0;
            width: 100%;
            height: 12pt;
            background: #111;
        }
    </style>
</head>
<body>
    <div class="card-wrapper">
        <div class="blue-header">
            <div class="logo-box">
                <img src="{{ public_path('logo-dinsos.jpg') }}" class="logo-img">
            </div>
            <div class="title-top">DINAS SOSIAL</div>
            <div class="title-bottom">KABUPATEN LAMONGAN</div>
        </div>

        <div class="photo-section">
            @php
                $photo = $user->photo_path && file_exists(public_path('storage/' . $user->photo_path)) 
                    ? public_path('storage/' . $user->photo_path) 
                    : null;
            @endphp
            @if($photo)
                <img src="{{ $photo }}" class="photo-img">
            @else
                <div class="photo-img" style="display:inline-block; line-height:130pt; color:#ccc;">NO PHOTO</div>
            @endif
        </div>

        <div class="info-section">
            <div class="name-txt">{{ $user->name }}</div>
            <div class="nim-txt">{{ $user->nim }}</div>
            <div class="school-txt">{{ $user->school }}</div>
            <div style="font-size: 7pt; color: #999; margin-top: 5pt; font-weight: bold;">IDENTITAS PESERTA MAGANG</div>
        </div>

        <div class="qr-section">
            <img src="data:image/svg+xml;base64,{{ $qrCode }}" class="qr-img">
        </div>

        <div class="footer-strip"></div>
    </div>
</body>
</html>
