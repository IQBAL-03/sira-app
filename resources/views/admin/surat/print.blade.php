<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Surat Pengantar - {{ $letter->letter_type }}</title>
    <style>
        body { font-family: 'Times New Roman', serif; margin: 0; padding: 40px; color: #1E293B; }
        .header { text-align: center; border-bottom: 3px double #1E293B; padding-bottom: 16px; margin-bottom: 20px; }
        .header h1 { font-size: 20px; font-weight: bold; margin: 0; text-transform: uppercase; }
        .header h2 { font-size: 14px; font-weight: normal; margin: 4px 0 0; }
        .header p { font-size: 11px; margin: 2px 0; }
        .title { text-align: center; margin: 20px 0; }
        .title h3 { font-size: 16px; font-weight: bold; text-decoration: underline; text-transform: uppercase; }
        .title p { font-size: 11px; margin: 2px 0; }
        table { width: 100%; border-collapse: collapse; margin: 16px 0; }
        td { padding: 4px 8px; font-size: 12px; vertical-align: top; }
        td:first-child { width: 160px; }
        td:nth-child(2) { width: 20px; }
        .body-text { font-size: 12px; line-height: 1.8; margin: 12px 0; text-align: justify; }
        .signature { margin-top: 40px; display: flex; justify-content: flex-end; }
        .signature-box { text-align: center; min-width: 200px; }
        .signature-box .date { font-size: 12px; }
        .signature-box .role { font-size: 12px; font-weight: bold; margin-bottom: 60px; }
        .signature-box .name { font-size: 12px; font-weight: bold; text-decoration: underline; }
        .signature-box .nik-text { font-size: 11px; }
        .footer-note { margin-top: 30px; border-top: 1px solid #ccc; padding-top: 10px; font-size: 10px; color: #666; }
        @media print { body { padding: 20px; } .no-print { display: none; } }
    </style>
</head>
<body>
    <div class="no-print" style="text-align: center; margin-bottom: 20px; display: flex; justify-content: center; gap: 10px;">
        <button onclick="window.print()" style="background: #DC2626; color: white; border: none; padding: 10px 24px; border-radius: 8px; font-size: 14px; cursor: pointer; font-family: Arial, sans-serif; display: inline-flex; items-center; gap: 6px;">
            🖨️ Cetak Surat
        </button>
        <a href="{{ route('admin.surat.pdf', $letter) }}" style="background: #1E293B; color: white; text-decoration: none; padding: 10px 24px; border-radius: 8px; font-size: 14px; cursor: pointer; font-family: Arial, sans-serif; display: inline-flex; items-center; gap: 6px;">
            📥 Unduh PDF
        </a>
    </div>

    <div class="header">
        <h1>Pemerintah Kelurahan — Surat Pengantar RT/RW</h1>
        <h2>Rukun Tetangga / Rukun Warga</h2>
        <p>Jl. Contoh No. 01, Kelurahan Contoh, Kecamatan Contoh, Kota Contoh</p>
    </div>

    <div class="title">
        <h3>Surat Pengantar</h3>
        <p>Nomor: SP/{{ $letter->id }}/{{ $letter->created_at->format('Y') }}</p>
    </div>

    <p class="body-text">Yang bertanda tangan di bawah ini, Ketua RT/RW menerangkan bahwa:</p>

    <table>
        <tr><td>Nama Lengkap</td><td>:</td><td><strong>{{ $letter->user->name }}</strong></td></tr>
        <tr><td>NIK</td><td>:</td><td>{{ $letter->user->nik }}</td></tr>
        <tr><td>No. Telepon</td><td>:</td><td>{{ $letter->user->phone }}</td></tr>
        <tr><td>Alamat</td><td>:</td><td>{{ $letter->user->address }}</td></tr>
        <tr><td>Jenis Surat</td><td>:</td><td><strong>{{ $letter->letter_type }}</strong></td></tr>
        <tr><td>Keperluan</td><td>:</td><td>{{ $letter->purpose }}</td></tr>
    </table>

    <p class="body-text">
        Adalah benar warga yang berdomisili di wilayah kami. Surat pengantar ini dibuat dengan sebenar-benarnya untuk keperluan tersebut di atas dan dapat dipergunakan sebagaimana mestinya.
    </p>

    <p class="body-text">Demikian surat pengantar ini dibuat untuk dapat dipergunakan seperlunya.</p>

    <div class="signature">
        <div class="signature-box">
            <p class="date">{{ now()->locale('id')->isoFormat('D MMMM YYYY') }}</p>
            <p class="role">Ketua RT/RW</p>
            <p class="name">___________________________</p>
            <p class="nik-text">Pengurus RT/RW</p>
        </div>
    </div>

    <div class="footer-note">
        Surat ini dicetak secara digital melalui Sistem Informasi SIRA. Tanggal cetak: {{ now()->format('d/m/Y H:i') }}
    </div>
</body>
</html>
