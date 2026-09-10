<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <title>Laporan Pengaduan Warga</title>
    <style>
        @page {
            margin: 1.5cm;
            size: landscape;
        }
        body {
            font-family: Arial, Helvetica, sans-serif;
            font-size: 9pt;
            color: #1e293b;
        }
        .header {
            text-align: center;
            border-bottom: 2px solid #dc2626;
            padding-bottom: 10px;
            margin-bottom: 15px;
        }
        .header h1 {
            font-size: 14pt;
            font-weight: bold;
            color: #dc2626;
            margin: 0;
            text-transform: uppercase;
        }
        .header p {
            font-size: 9pt;
            color: #64748b;
            margin: 3px 0 0;
        }
        .info-bar {
            margin-bottom: 12px;
            font-size: 8.5pt;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 5px;
        }
        th, td {
            border: 1px solid #cbd5e1;
            padding: 6px 8px;
            vertical-align: top;
        }
        th {
            background-color: #f1f5f9;
            color: #334155;
            font-weight: bold;
            text-align: left;
            font-size: 8.5pt;
            text-transform: uppercase;
        }
        tr:nth-child(even) {
            background-color: #f8fafc;
        }
        .badge {
            display: inline-block;
            padding: 2px 6px;
            border-radius: 4px;
            font-size: 8pt;
            font-weight: bold;
        }
        .badge-pending {
            background-color: #fef3c7;
            color: #b45309;
        }
        .badge-process {
            background-color: #dbeafe;
            color: #1d4ed8;
        }
        .badge-resolved {
            background-color: #dcfce7;
            color: #15803d;
        }
        .photo-img {
            width: 70px;
            height: 70px;
            object-fit: cover;
            border-radius: 4px;
            border: 1px solid #cbd5e1;
        }
        .no-photo {
            font-size: 8pt;
            color: #94a3b8;
            font-style: italic;
        }
        .footer {
            margin-top: 15px;
            text-align: right;
            font-size: 8pt;
            color: #94a3b8;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>Laporan Rekapitulasi Pengaduan Warga</h1>
        <p>Sistem Informasi RT/RW (SIRA) — Dicetak pada: {{ now()->translatedFormat('d F Y H:i') }}</p>
    </div>

    <div class="info-bar">
        <strong>Total Pengaduan:</strong> {{ $complaints->count() }} Data
    </div>

    <table>
        <thead>
            <tr>
                <th style="width: 25px; text-align: center;">No</th>
                <th style="width: 110px;">Nama Pelapor</th>
                <th style="width: 85px;">No. Telepon</th>
                <th style="width: 130px;">Judul Laporan</th>
                <th>Deskripsi Pengaduan</th>
                <th style="width: 80px; text-align: center;">Foto Bukti</th>
                <th style="width: 70px; text-align: center;">Status</th>
                <th style="width: 75px; text-align: center;">Tanggal</th>
            </tr>
        </thead>
        <tbody>
            @forelse($complaints as $index => $complaint)
                <tr>
                    <td style="text-align: center;">{{ $index + 1 }}</td>
                    <td>
                        <strong>{{ $complaint->user->name ?? 'N/A' }}</strong><br>
                        <span style="font-size: 8pt; color: #64748b;">NIK: {{ $complaint->user->nik ?? '-' }}</span>
                    </td>
                    <td>{{ $complaint->user->phone ?? '-' }}</td>
                    <td><strong>{{ $complaint->title }}</strong></td>
                    <td style="font-size: 8.5pt;">{{ $complaint->description }}</td>
                    <td style="text-align: center; vertical-align: middle;">
                        @if($complaint->photo_base64)
                            <img src="{{ $complaint->photo_base64 }}" class="photo-img" alt="Foto Laporan">
                        @else
                            <span class="no-photo">Tidak ada foto</span>
                        @endif
                    </td>
                    <td style="text-align: center;">
                        <span class="badge {{ $complaint->status === 'pending' ? 'badge-pending' : ($complaint->status === 'process' ? 'badge-process' : 'badge-resolved') }}">
                            {{ $complaint->status === 'pending' ? 'Pending' : ($complaint->status === 'process' ? 'Diproses' : 'Selesai') }}
                        </span>
                    </td>
                    <td style="text-align: center; font-size: 8pt;">
                        {{ $complaint->created_at->format('d/m/Y H:i') }}
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="8" style="text-align: center; padding: 15px; color: #94a3b8;">
                        Tidak ada data pengaduan.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="footer">
        Dicetak secara otomatis oleh Sistem Informasi RT/RW (SIRA)
    </div>
</body>
</html>
