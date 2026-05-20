<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Cetak ID Card Magang</title>
    <style>
        @page { margin: 0; size: 210pt 330pt; }
        body {
            margin: 0; padding: 0;
            width: 210pt; height: 330pt;
            font-family: 'Helvetica', 'Arial', sans-serif;
            color: #0f172a;
            background-color: #ffffff;
            -webkit-print-color-adjust: exact;
        }

        .card-container {
            width: 210pt; height: 330pt;
            position: relative;
            box-sizing: border-box;
            background-color: #ffffff;
            border: 1.5pt solid #e2e8f0;
            overflow: hidden;
        }

        /* Lanyard Slot Hole Punch representation */
        .lanyard-slot {
            position: absolute; top: 6pt; left: 93pt;
            width: 24pt; height: 5pt;
            background-color: #f1f5f9; 
            border: 1pt solid #cbd5e1; 
            border-radius: 10pt;
            z-index: 50;
        }

        /* Header Accent Bar */
        .header-bar {
            position: relative; z-index: 10;
            background-color: #0f172a;
            color: #ffffff;
            padding: 16pt 10pt 8pt 10pt;
            text-align: center;
            border-bottom: 2.5pt solid #2563eb;
        }
        .header-bar .instansi {
            font-size: 8.5pt; font-weight: 800;
            letter-spacing: 0.8pt;
            text-transform: uppercase;
            color: #ffffff;
        }
        .header-bar .program {
            font-size: 6.5pt; font-weight: 700;
            letter-spacing: 1.5pt;
            text-transform: uppercase;
            color: #60a5fa;
            margin-top: 1.5pt;
        }

        /* Content Area */
        .content {
            padding: 10pt 12pt;
            text-align: center;
        }

        /* Rounded Photo Frame */
        .photo-frame {
            width: 105pt; height: 135pt;
            margin: 5pt auto 0 auto;
            border-radius: 14pt;
            border: 2pt solid #e2e8f0;
            background-color: #f8fafc;
            overflow: hidden;
            box-shadow: 0 4pt 10pt rgba(15, 23, 42, 0.04);
            box-sizing: border-box;
        }
        .photo-img {
            width: 100%; height: 100%; object-fit: cover;
        }
        .photo-placeholder {
            padding-top: 55pt;
            color: #94a3b8;
            font-size: 6.5pt;
            font-weight: 800;
            letter-spacing: 1pt;
            text-transform: uppercase;
        }

        /* Student Metadata Display */
        .badge-tag {
            display: inline-block;
            background-color: #2563eb;
            color: #ffffff;
            font-size: 6pt;
            font-weight: 800;
            letter-spacing: 1.2pt;
            text-transform: uppercase;
            padding: 2.5pt 8pt;
            border-radius: 50pt;
            margin-top: 10pt;
        }

        .name-box {
            margin-top: 8pt;
            text-align: center;
        }
        .name-text {
            font-size: 11pt; font-weight: 800;
            color: #0f172a; line-height: 1.2;
            text-transform: uppercase;
        }
        .school-text {
            color: #475569; font-size: 7.5pt; font-weight: 700;
            margin-top: 3pt; text-transform: uppercase;
        }
        .nim-text {
            color: #94a3b8; font-size: 6.5pt; font-weight: 800;
            letter-spacing: 0.5pt;
            margin-top: 1.5pt; text-transform: uppercase;
        }

        /* Footer elements */
        .footer-line {
            position: absolute; bottom: 0; left: 0; right: 0;
            height: 4pt; background-color: #0f172a;
        }

        /* ==================== BACK SIDE ==================== */
        .back-title {
            font-size: 7pt; font-weight: 800; color: #94a3b8;
            text-transform: uppercase; letter-spacing: 1pt;
            text-align: center; margin-top: 5pt;
        }
        .back-subtitle {
            font-size: 10pt; font-weight: 800; color: #0f172a;
            text-transform: uppercase; letter-spacing: 0.5pt;
            text-align: center; margin-top: 1pt;
        }

        .qr-frame {
            margin: 16pt auto 0 auto;
            width: 80pt; height: 80pt;
            background-color: #ffffff;
            padding: 4pt;
            border: 1pt solid #e2e8f0;
            border-radius: 12pt;
            box-shadow: 0 4pt 10pt rgba(15, 23, 42, 0.03);
            text-align: center;
        }
        .qr-img { width: 80pt; height: 80pt; }

        .rules-text {
            font-size: 5.5pt; color: #64748b; font-weight: 600;
            line-height: 1.4; text-align: center;
            margin: 14pt auto 0 auto; width: 175pt;
        }

        .info-table {
            width: 175pt; margin: 15pt auto 0 auto; border-collapse: collapse;
        }
        .info-table td {
            padding: 4.5pt 2pt; border-bottom: 0.8pt solid #f1f5f9;
            font-size: 7.5pt;
        }
        .info-label {
            color: #94a3b8; font-weight: 700; text-transform: uppercase; width: 35%;
        }
        .info-val {
            color: #334155; font-weight: 700; text-align: right; text-transform: uppercase;
        }
    </style>
</head>
<body>
    @php \Carbon\Carbon::setLocale('id'); @endphp
    
    <!-- FRONT OF CARD -->
    <div class="card-container">
        <div class="lanyard-slot"></div>
        
        <div class="header-bar">
            <div class="instansi">Dinas Sosial</div>
            <div class="program">Peserta Magang</div>
        </div>

        <div class="content">
            <div class="photo-frame">
                @if($photoBase64)
                    <img src="{{ $photoBase64 }}" class="photo-img">
                @else
                    <div class="photo-placeholder">Pas Foto</div>
                @endif
            </div>

            <div class="badge-tag">Identitas Resmi</div>

            <div class="name-box">
                <div class="name-text">{{ $user->name }}</div>
                <div class="school-text">{{ $user->school }}</div>
                <div class="nim-text">NIM. {{ $user->nim }}</div>
            </div>
        </div>

        <div class="footer-line"></div>
    </div>
    
    <!-- BACK OF CARD -->
    <div class="card-container" style="page-break-before: always;">
        <div class="lanyard-slot"></div>
        
        <div class="header-bar" style="border-bottom: 2.5pt solid #0f172a;">
            <div class="instansi">Verification Code</div>
            <div class="program" style="color: #94a3b8;">Dinas Sosial Kabupaten</div>
        </div>

        <div class="content">
            <!-- QR Code Framed nicely -->
            <div class="qr-frame">
                <img src="data:image/svg+xml;base64,{{ $qrCode }}" class="qr-img">
            </div>

            <p class="rules-text">
                Kartu ini merupakan tanda pengenal resmi peserta magang Dinas Sosial. Wajib dikenakan selama berada di area kerja dan digunakan untuk verifikasi kehadiran harian.
            </p>

            <table class="info-table">
                <tr>
                    <td class="info-label">Nama</td>
                    <td class="info-val">{{ $user->name }}</td>
                </tr>
                <tr>
                    <td class="info-label">Nomor Induk</td>
                    <td class="info-val">{{ $user->nim }}</td>
                </tr>
                <tr>
                    <td class="info-label">Instansi</td>
                    <td class="info-val">{{ $user->school }}</td>
                </tr>
                <tr>
                    <td class="info-label">Status</td>
                    <td class="info-val" style="color: #2563eb; font-weight: 800;">
                        {{ $user->status === 'finished' ? 'Selesai' : 'Aktif' }}
                    </td>
                </tr>
            </table>
        </div>
        
        <div class="footer-line" style="background-color: #2563eb;"></div>
    </div>
</body>
</html>
