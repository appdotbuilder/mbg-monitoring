<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Distribusi - {{ $sekolah->nama_sekolah }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            line-height: 1.4;
            margin: 0;
            padding: 20px;
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
            border-bottom: 2px solid #000;
            padding-bottom: 20px;
        }
        .header h1 {
            margin: 0 0 10px 0;
            font-size: 18px;
            color: #333;
        }
        .header h2 {
            margin: 0 0 5px 0;
            font-size: 16px;
            color: #666;
        }
        .info-section {
            margin-bottom: 20px;
            background-color: #f8f9fa;
            padding: 15px;
            border-radius: 5px;
        }
        .info-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 10px;
        }
        .info-item {
            margin-bottom: 5px;
        }
        .info-label {
            font-weight: bold;
            color: #333;
        }
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 15px;
            margin-bottom: 30px;
        }
        .stat-card {
            background-color: #e3f2fd;
            padding: 15px;
            border-radius: 5px;
            text-align: center;
            border: 1px solid #bbdefb;
        }
        .stat-number {
            font-size: 24px;
            font-weight: bold;
            color: #1976d2;
            margin-bottom: 5px;
        }
        .stat-label {
            font-size: 11px;
            color: #666;
        }
        .table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        .table th,
        .table td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        .table th {
            background-color: #f5f5f5;
            font-weight: bold;
            text-align: center;
        }
        .table tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        .status-badge {
            display: inline-block;
            padding: 3px 8px;
            border-radius: 3px;
            font-size: 10px;
            font-weight: bold;
        }
        .status-selesai {
            background-color: #d4edda;
            color: #155724;
        }
        .status-belum {
            background-color: #fff3cd;
            color: #856404;
        }
        .footer {
            margin-top: 30px;
            text-align: center;
            font-size: 10px;
            color: #666;
            border-top: 1px solid #ddd;
            padding-top: 15px;
        }
        .summary {
            background-color: #f1f8ff;
            padding: 15px;
            border-left: 4px solid #1976d2;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <!-- Header -->
    <div class="header">
        <h1>🏫 LAPORAN DISTRIBUSI MAKANAN BERGIZI GRATIS</h1>
        <h2>{{ $sekolah->nama_sekolah }}</h2>
        <p>Periode: {{ $startDate->format('d F Y') }} - {{ $endDate->format('d F Y') }}</p>
    </div>

    <!-- School Information -->
    <div class="info-section">
        <h3 style="margin-top: 0;">📋 Informasi Sekolah</h3>
        <div class="info-grid">
            <div>
                <div class="info-item">
                    <span class="info-label">Nama Sekolah:</span> {{ $sekolah->nama_sekolah }}
                </div>
                <div class="info-item">
                    <span class="info-label">Kepala Sekolah:</span> {{ $sekolah->kepala_sekolah }}
                </div>
                <div class="info-item">
                    <span class="info-label">Alamat:</span> {{ $sekolah->alamat }}
                </div>
            </div>
            <div>
                @if($sekolah->telepon)
                    <div class="info-item">
                        <span class="info-label">Telepon:</span> {{ $sekolah->telepon }}
                    </div>
                @endif
                @if($sekolah->email)
                    <div class="info-item">
                        <span class="info-label">Email:</span> {{ $sekolah->email }}
                    </div>
                @endif
                <div class="info-item">
                    <span class="info-label">Total Siswa:</span> {{ $sekolah->jumlah_siswa }} siswa
                </div>
            </div>
        </div>
    </div>

    <!-- Statistics -->
    <div class="stats-grid">
        <div class="stat-card">
            <div class="stat-number">{{ $totalDistribusi }}</div>
            <div class="stat-label">Total Distribusi</div>
        </div>
        <div class="stat-card">
            <div class="stat-number">{{ number_format($totalPorsi) }}</div>
            <div class="stat-label">Total Porsi</div>
        </div>
        <div class="stat-card">
            <div class="stat-number">{{ $distribusiSelesai }}</div>
            <div class="stat-label">Distribusi Selesai</div>
        </div>
        <div class="stat-card">
            <div class="stat-number">{{ $distribusiBelum }}</div>
            <div class="stat-label">Distribusi Belum</div>
        </div>
    </div>

    <!-- Summary -->
    @if($totalDistribusi > 0)
        <div class="summary">
            <h3 style="margin-top: 0;">📊 Ringkasan</h3>
            <p>
                Dalam periode {{ $startDate->format('d F Y') }} - {{ $endDate->format('d F Y') }}, 
                <strong>{{ $sekolah->nama_sekolah }}</strong> telah menerima 
                <strong>{{ number_format($totalPorsi) }} porsi</strong> makanan bergizi gratis 
                melalui <strong>{{ $totalDistribusi }} kali distribusi</strong>.
            </p>
            <p>
                Tingkat penyelesaian distribusi: 
                <strong>{{ $totalDistribusi > 0 ? round(($distribusiSelesai / $totalDistribusi) * 100, 1) : 0 }}%</strong>
                ({{ $distribusiSelesai }} dari {{ $totalDistribusi }} distribusi selesai).
            </p>
        </div>
    @endif

    <!-- Distribution Table -->
    <h3>📋 Detail Distribusi</h3>
    @if($distribusi->count() > 0)
        <table class="table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Tanggal</th>
                    <th>Kendaraan</th>
                    <th>Jumlah Porsi</th>
                    <th>Status</th>
                    <th>Waktu Berangkat</th>
                    <th>Waktu Tiba</th>
                    <th>Catatan</th>
                </tr>
            </thead>
            <tbody>
                @foreach($distribusi as $index => $item)
                    <tr>
                        <td style="text-align: center;">{{ $index + 1 }}</td>
                        <td>{{ $item->tanggal_distribusi->format('d/m/Y') }}</td>
                        <td>{{ $item->kendaraan->nama_kendaraan }}</td>
                        <td style="text-align: right;">{{ number_format($item->jumlah_porsi) }}</td>
                        <td>
                            <span class="status-badge {{ $item->status === 'sudah' ? 'status-selesai' : 'status-belum' }}">
                                {{ $item->status === 'sudah' ? 'SELESAI' : 'BELUM' }}
                            </span>
                        </td>
                        <td>{{ $item->waktu_berangkat ?: '-' }}</td>
                        <td>{{ $item->waktu_tiba ?: '-' }}</td>
                        <td>{{ $item->catatan ?: '-' }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p style="text-align: center; color: #666; padding: 20px;">
            Tidak ada data distribusi dalam periode yang dipilih.
        </p>
    @endif

    <!-- Footer -->
    <div class="footer">
        <p>Laporan dibuat pada {{ now()->format('d F Y H:i:s') }}</p>
        <p>Sistem Manajemen Distribusi Makanan Bergizi Gratis</p>
    </div>
</body>
</html>