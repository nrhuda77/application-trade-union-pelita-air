<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Pengumuman Event</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            color: #333;
            line-height: 1.6;
        }
        .container {
            padding: 20px;
            border: 1px solid #ddd;
            background: #f9f9f9;
            max-width: 600px;
            margin: auto;
        }
        .header {
            text-align: center;
            padding-bottom: 20px;
        }
        .kategori {
            background: #007bff;
            color: white;
            padding: 5px 10px;
            display: inline-block;
            border-radius: 4px;
            font-size: 14px;
        }
        .lampiran img {
            max-width: 100%;
            margin-top: 15px;
        }
        .info {
            margin-top: 15px;
        }
        .label {
            font-weight: bold;
        }
        .footer {
            margin-top: 30px;
            font-size: 12px;
            color: #666;
            text-align: center;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="header">
        <h2>{{ $isi_email['judul'] }}</h2>
        <div class="kategori">{{ ucfirst($isi_email['kategori']) }}</div>
    </div>
    
    
        <div class="lampiran">
            <img src="{{ $isi_email['lampiran'] }}" alt="Lampiran Gambar">
        </div>

    <p>{!! nl2br(e($isi_email['isi'])) !!}</p>




    <div class="info">
        <p><span class="label">Waktu Acara:</span> {{ \Carbon\Carbon::parse($isi_email['waktu_event'])->format('d M Y H:i') }}</p>
        <p><span class="label">Lokasi:</span> {{ $isi_email['lokasi_event'] }}</p>

    
    </div>

    <div class="footer">
        <p>Ini adalah notifikasi email otomatis . Mohon tidak membalas pesan ini.</p>
    </div>
</div>
</body>
</html>
