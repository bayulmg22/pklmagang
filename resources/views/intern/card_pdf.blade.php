<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>ID Card Magang - {{ $user->name }}</title>
    <style>
        @page { margin: 0; }
        body {
            font-family: 'Helvetica', 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #ffffff;
        }
        .card-container {
            width: 320px;
            height: 500px;
            margin: 40px auto;
            position: relative;
            background-color: #ffffff;
            border-radius: 30px;
            overflow: hidden;
            border: 1px solid #e5e7eb;
        }
        .header {
            background-color: #1d4ed8;
            height: 140px;
            text-align: center;
            padding-top: 25px;
            position: relative;
        }
        .header-bg-accent {
            position: absolute;
            top: -50px;
            right: -50px;
            width: 150px;
            height: 150px;
            background-color: rgba(255,255,255,0.1);
            border-radius: 50%;
        }
        .logo {
            height: 45px;
            width: auto;
            background-color: #ffffff;
            border-radius: 8px;
            padding: 4px;
            margin-bottom: 8px;
        }
        .header h3 {
            color: #ffffff;
            margin: 0;
            font-size: 16px;
            font-weight: bold;
            letter-spacing: 2px;
        }
        .header p {
            color: rgba(255,255,255,0.9);
            margin: 2px 0 0;
            font-size: 10px;
            text-transform: uppercase;
            letter-spacing: 1px;
        }
        .photo-area {
            text-align: center;
            position: relative;
            z-index: 10;
            margin-top: -60px;
        }
        .photo {
            width: 110px;
            height: 140px;
            background-color: #f3f4f6;
            border: 5px solid #ffffff;
            border-radius: 15px;
            display: inline-block;
            object-fit: cover;
        }
        .details {
            text-align: center;
            padding: 10px 30px;
        }
        .details h2 {
            margin: 15px 0 4px;
            font-size: 18px;
            font-weight: bold;
            color: #1e3a8a;
            text-transform: uppercase;
        }
        .details .nim {
            font-weight: bold;
            color: #0d9488;
            font-size: 14px;
            letter-spacing: 1px;
            margin-bottom: 15px;
        }
        .line {
            height: 1px;
            background: #e5e7eb;
            margin: 10px 0;
        }
        .details .school {
            font-size: 11px;
            color: #6b7280;
            font-weight: bold;
            text-transform: uppercase;
            margin-bottom: 4px;
        }
        .details .role-badge {
            display: inline-block;
            background-color: #eff6ff;
            color: #1d4ed8;
            font-size: 10px;
            font-weight: bold;
            padding: 4px 12px;
            border-radius: 50px;
            letter-spacing: 1px;
        }
        .qr-area {
            text-align: center;
            margin-top: 15px;
            margin-bottom: 25px;
        }
        .qr-area img {
            width: 80px;
            height: 80px;
            padding: 5px;
            border: 1px solid #f0fdf4;
            background: #ffffff;
        }
        .qr-label {
            font-size: 8px;
            font-weight: bold;
            color: #9ca3af;
            letter-spacing: 2px;
            margin-top: 5px;
        }
        .footer {
            position: absolute;
            bottom: 0;
            width: 100%;
            background-color: #1e3a8a;
            color: #ffffff;
            text-align: center;
            padding: 10px 0;
            font-size: 10px;
            font-weight: bold;
            letter-spacing: 3px;
            text-transform: uppercase;
        }
    </style>
</head>
<body>

    <div class="card-container">
        <div class="header">
            <div class="header-bg-accent"></div>
            <img src="{{ public_path('logo-dinsos.jpg') }}" class="logo" alt="Logo">
            <h3>DINAS SOSIAL</h3>
            <p>Kabupaten Lamongan</p>
        </div>
        
        <div class="photo-area">
            @if($user->photo_path)
                <img src="{{ public_path('storage/' . $user->photo_path) }}" class="photo" alt="Photo">
            @else
                <div class="photo" style="line-height: 140px; color: #9ca3af; font-size: 12px;">NO PHOTO</div>
            @endif
        </div>

        <div class="details">
            <h2>{{ $user->name }}</h2>
            <p class="nim">{{ $user->nim }}</p>
            <div class="line"></div>
            <p class="school">{{ $user->school }}</p>
            <p class="role-badge">PESERTA MAGANG</p>
        </div>

        <div class="qr-area">
            <img src="data:image/svg+xml;base64,{{ $qrCode }}" alt="QR Code">
            <p class="qr-label">SIMASOS ID PASS</p>
        </div>

        <div class="footer">
            DIGITAL PASS
        </div>
    </div>

</body>
</html>
