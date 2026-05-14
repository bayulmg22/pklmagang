<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>ID Card Magang - {{ $user->name }}</title>
    <style>
        body {
            font-family: 'Helvetica', 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f3f4f6;
        }
        .card {
            width: 320px;
            height: 500px;
            background: white;
            border-radius: 15px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
            margin: 50px auto;
            position: relative;
            overflow: hidden;
            border: 2px solid #e5e7eb;
        }
        .header {
            background-color: #0ea5e9;
            color: white;
            text-align: center;
            padding: 15px 0;
            border-radius: 13px 13px 0 0;
        }
        .header h3 { margin: 0; font-size: 16px; font-weight: bold; }
        .header p { margin: 5px 0 0; font-size: 12px; }
        .photo-area {
            text-align: center;
            margin-top: 20px;
        }
        .photo {
            width: 100px;
            height: 120px;
            background-color: #f3f4f6;
            border: 3px solid #22c55e;
            border-radius: 10px;
            display: inline-block;
            object-fit: cover;
        }
        .details {
            text-align: center;
            padding: 10px 20px;
        }
        .details h2 { margin: 10px 0 5px; font-size: 20px; color: #1f2937; }
        .details p { margin: 2px 0; font-size: 14px; color: #4b5563; }
        .details .nim { font-weight: bold; color: #0ea5e9; }
        .qr-area {
            text-align: center;
            margin-top: 15px;
        }
        .qr-area img {
            width: 100px;
            height: 100px;
        }
        .footer {
            position: absolute;
            bottom: 0;
            width: 100%;
            background-color: #22c55e;
            color: white;
            text-align: center;
            padding: 10px 0;
            font-size: 12px;
            font-weight: bold;
        }
    </style>
</head>
<body>

    <div class="card">
        <div class="header">
            <h3>DINAS SOSIAL</h3>
            <p>Kabupaten Lamongan</p>
        </div>
        
        <div class="photo-area">
            @if($user->photo_path)
                <!-- Usually dompdf requires absolute path for local files or full url -->
                <img src="{{ public_path('storage/' . $user->photo_path) }}" class="photo" alt="Photo">
            @else
                <div class="photo" style="line-height: 120px; color: #9ca3af;">Foto</div>
            @endif
        </div>

        <div class="details">
            <h2>{{ $user->name }}</h2>
            <p class="nim">{{ $user->nim }}</p>
            <p>{{ $user->school }}</p>
            <p style="font-size: 12px; margin-top: 5px; font-weight: bold; color: #374151;">PESERTA MAGANG</p>
        </div>

        <div class="qr-area">
            <img src="data:image/svg+xml;base64,{{ $qrCode }}" alt="QR Code">
        </div>

        <div class="footer">
            PORTAL MAGANG DIGITAL
        </div>
    </div>

</body>
</html>
