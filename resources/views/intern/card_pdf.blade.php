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
            width: 300px;
            height: 480px;
            margin: 40px auto;
            position: relative;
            background-color: #ffffff;
            border-radius: 15px;
            overflow: hidden;
            border: 1px solid #d1d5db;
        }
        .header {
            background-color: #2563eb;
            height: 120px;
            text-align: center;
            padding-top: 20px;
        }
        .logo {
            height: 40px;
            width: auto;
            background-color: #ffffff;
            border-radius: 4px;
            padding: 2px;
            margin-bottom: 8px;
        }
        .header h3 {
            color: #ffffff;
            margin: 0;
            font-size: 14px;
            font-weight: bold;
            letter-spacing: 1px;
        }
        .header p {
            color: #bfdbfe;
            margin: 2px 0 0;
            font-size: 9px;
            text-transform: uppercase;
            letter-spacing: 2px;
            font-weight: bold;
        }
        .photo-area {
            text-align: center;
            margin-top: -60px;
        }
        .photo {
            width: 105px;
            height: 135px;
            background-color: #f3f4f6;
            border: 5px solid #ffffff;
            border-radius: 10px;
            display: inline-block;
        }
        .details {
            text-align: center;
            padding: 10px 20px;
        }
        .details h2 {
            margin: 15px 0 4px;
            font-size: 18px;
            font-weight: bold;
            color: #111827;
            text-transform: uppercase;
        }
        .details .nim {
            font-weight: bold;
            color: #2563eb;
            font-size: 14px;
            letter-spacing: 1px;
            margin-bottom: 12px;
        }
        .separator {
            height: 3px;
            width: 40px;
            background-color: #2563eb;
            margin: 10px auto;
            border-radius: 50px;
        }
        .details .school {
            font-size: 10px;
            color: #4b5563;
            font-weight: bold;
            text-transform: uppercase;
            margin-bottom: 2px;
        }
        .details .badge {
            font-size: 8px;
            color: #9ca3af;
            text-transform: uppercase;
            letter-spacing: 2px;
            font-weight: bold;
        }
        .qr-area {
            text-align: center;
            position: absolute;
            bottom: 40px;
            width: 100%;
        }
        .qr-area img {
            width: 80px;
            height: 80px;
            border: 1px solid #f3f4f6;
            padding: 4px;
        }
        .qr-label {
            font-size: 7px;
            font-weight: bold;
            color: #d1d5db;
            letter-spacing: 2px;
            margin-top: 4px;
            text-transform: uppercase;
        }
        .footer {
            position: absolute;
            bottom: 0;
            width: 100%;
            background-color: #111827;
            color: #9ca3af;
            text-align: center;
            padding: 6px 0;
            font-size: 8px;
            font-weight: bold;
            letter-spacing: 2px;
            text-transform: uppercase;
        }
    </style>
</head>
<body>

    <div class="card-container">
        <div class="header">
            <img src="{{ public_path('logo-dinsos.jpg') }}" class="logo" alt="Logo">
            <h3>DINAS SOSIAL</h3>
            <p>Kabupaten Lamongan</p>
        </div>
        
        <div class="photo-area">
            @if($user->photo_path)
                <img src="{{ public_path('storage/' . $user->photo_path) }}" class="photo" alt="Photo">
            @else
                <div class="photo" style="background-color: #f3f4f6;"></div>
            @endif
        </div>

        <div class="details">
            <h2>{{ $user->name }}</h2>
            <p class="nim">{{ $user->nim }}</p>
            <div class="separator"></div>
            <p class="school">{{ $user->school }}</p>
            <p class="badge">Peserta Magang</p>
        </div>

        <div class="qr-area">
            <img src="data:image/svg+xml;base64,{{ $qrCode }}" alt="QR Code">
            <p class="qr-label">Digital SIMASOS ID Pass</p>
        </div>

        <div class="footer">
            Identification Card &bull; Dinas Sosial Lamongan
        </div>
    </div>

</body>
</html>
