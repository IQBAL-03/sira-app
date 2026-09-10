<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <title>Surat Pengantar - {{ $letter->letter_type }}</title>
    <style>
        @page {
            margin: 2.5cm 2.5cm 2.5cm 2.5cm;
        }
        body {
            font-family: 'Times New Roman', Times, serif;
            font-size: 12pt;
            line-height: 1.6;
            color: #000;
        }
        .header {
            text-align: center;
            border-bottom: 3px double #000;
            padding-bottom: 12px;
            margin-bottom: 20px;
        }
        .header h1 {
            font-size: 14pt;
            font-weight: bold;
            margin: 0;
            text-transform: uppercase;
        }
        .header h2 {
            font-size: 12pt;
            font-weight: bold;
            margin: 4px 0 0;
            text-transform: uppercase;
        }
        .header p {
            font-size: 10pt;
            margin: 2px 0;
        }
        .title {
            text-align: center;
            margin: 20px 0;
        }
        .title h3 {
            font-size: 13pt;
            font-weight: bold;
            text-decoration: underline;
            text-transform: uppercase;
            margin: 0;
        }
        .title p {
            font-size: 11pt;
            margin: 4px 0 0;
        }
        .content-table {
            width: 100%;
            border-collapse: collapse;
            margin: 15px 0;
        }
        .content-table td {
            padding: 4px 6px;
            font-size: 11pt;
            vertical-align: top;
        }
        .body-text {
            font-size: 11pt;
            text-align: justify;
            margin: 10px 0;
        }
        .signature-table {
            width: 100%;
            margin-top: 35px;
            border-collapse: collapse;
        }
        .signature-table td {
            vertical-align: top;
        }
        .signature-box {
            text-align: center;
            width: 250px;
            float: right;
        }
        .signature-box .date {
            font-size: 11pt;
            margin-bottom: 4px;
        }
        .signature-box .role {
            font-size: 11pt;
            font-weight: bold;
            margin-bottom: 70px;
        }
        .signature-box .name {
            font-size: 11pt;
            font-weight: bold;
            text-decoration: underline;
            margin-bottom: 2px;
        }
        .signature-box .nik-text {
            font-size: 10pt;
        }
        .footer-note {
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            border-top: 1px solid #aaa;
            padding-top: 5px;
            font-size: 8pt;
            color: #555;
            text-align: center;
        }
    </style>
</head>
<body>
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

    <table class="content-table">
        <tr>
            <td style="width: 150px;">Nama Lengkap</td>
            <td style="width: 15px;">:</td>
            <td><strong>{{ $letter->user->name }}</strong></td>
        </tr>
        <tr>
            <td>NIK</td>
            <td>:</td>
            <td>{{ $letter->user->nik }}</td>
        </tr>
        <tr>
            <td>No. Telepon</td>
            <td>:</td>
            <td>{{ $letter->user->phone ?? '-' }}</td>
        </tr>
        <tr>
            <td>Alamat</td>
            <td>:</td>
            <td>{{ $letter->user->address ?? '-' }}</td>
        </tr>
        <tr>
            <td>Jenis Surat</td>
            <td>:</td>
            <td><strong>{{ $letter->letter_type }}</strong></td>
        </tr>
        <tr>
            <td>Keperluan</td>
            <td>:</td>
            <td>{{ $letter->purpose }}</td>
        </tr>
    </table>

    <p class="body-text">
        Adalah benar warga yang berdomisili di wilayah kami. Surat pengantar ini dibuat dengan sebenar-benarnya untuk keperluan tersebut di atas dan dapat dipergunakan sebagaimana mestinya.
    </p>

    <p class="body-text">Demikian surat pengantar ini dibuat untuk dapat dipergunakan seperlunya.</p>

    <table class="signature-table">
        <tr>
            <td style="width: 55%;"></td>
            <td style="width: 45%; text-align: center;">
                <div class="date">{{ now()->locale('id')->isoFormat('D MMMM YYYY') }}</div>
                <div class="role" style="font-weight: bold; margin-bottom: 70px;">Ketua RT/RW</div>
                <div class="name" style="font-weight: bold; text-decoration: underline;">___________________________</div>
                <div class="nik-text" style="font-size: 10pt;">Pengurus RT/RW</div>
            </td>
        </tr>
    </table>

    <div class="footer-note">
        Surat ini dicetak secara digital melalui Sistem Informasi SIRA pada tanggal {{ now()->format('d/m/Y H:i') }}
    </div>
</body>
</html>
