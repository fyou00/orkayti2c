<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Penjualan - {{ $startDate->format('d/m/Y') }} s/d {{ $endDate->format('d/m/Y') }}</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            font-family: Arial, sans-serif;
            padding: 20px;
            font-size: 12px;
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
            border-bottom: 2px solid #333;
            padding-bottom: 20px;
        }
        .header h1 {
            font-size: 24px;
            color: #333;
            margin-bottom: 5px;
        }
        .header h2 {
            font-size: 18px;
            color: #666;
            font-weight: normal;
        }
        .header p {
            color: #666;
            margin-top: 10px;
        }
        .summary {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 15px;
            margin-bottom: 30px;
        }
        .summary-card {
            border: 1px solid #ddd;
            padding: 15px;
            border-radius: 5px;
            background: #f9f9f9;
        }
        .summary-card h3 {
            font-size: 11px;
            color: #666;
            margin-bottom: 8px;
            text-transform: uppercase;
        }
        .summary-card p {
            font-size: 18px;
            font-weight: bold;
            color: #333;
        }
        .section {
            margin-bottom: 30px;
        }
        .section h3 {
            font-size: 14px;
            color: #333;
            margin-bottom: 15px;
            padding-bottom: 5px;
            border-bottom: 1px solid #333;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        table th {
            background: #333;
            color: white;
            padding: 10px;
            text-align: left;
            font-size: 11px;
            text-transform: uppercase;
        }
        table td {
            padding: 8px 10px;
            border-bottom: 1px solid #ddd;
        }
        table tbody tr:nth-child(even) {
            background: #f9f9f9;
        }
        table tfoot {
            background: #f0f0f0;
            font-weight: bold;
        }
        .footer {
            margin-top: 50px;
            padding-top: 20px;
            border-top: 1px solid #ddd;
            text-align: center;
            color: #666;
            font-size: 11px;
        }
        @media print {
            body {
                padding: 0;
            }
            .no-print {
                display: none;
            }
            @page {
                margin: 1cm;
            }
        }
        .print-btn {
            position: fixed;
            top: 20px;
            right: 20px;
            background: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 14px;
        }
        .print-btn:hover {
            background: #45a049;
        }
        .highlight {
            background: #fff3cd !important;
        }
    </style>
</head>
<body>
    <button onclick="window.print()" class="print-btn no-print">🖨️ Print Laporan</button>

    <div class="header">
        <h1>☕ KOPI PASTE</h1>
        <h2>Laporan Penjualan</h2>
        <p>Periode: {{ $startDate->format('d F Y') }} s/d {{ $endDate->format('d F Y') }}</p>
        <p style="font-size: 11px; margin-top: 5px;">Dicetak: {{ now()->format('d F Y H:i') }}</p>
    </div>

    <div class="summary">
        <div class="summary-card">
            <h3>Total Transaksi</h3>
            <p>{{ number_format($totalTransaksi) }}</p>
        </div>
        <div class="summary-card">
            <h3>Total Pendapatan</h3>
            <p>Rp {{ number_format($totalPendapatan) }}</p>
        </div>
        <div class="summary-card">
            <h3>Total Pesanan</h3>
            <p>{{ number_format($totalPesanan) }}</p>
        </div>
        <div class="summary-card">
            <h3>Rata-rata/Transaksi</h3>
            <p>Rp {{ number_format($rataRataTransaksi) }}</p>
        </div>
    </div>

    <div class="section">
        <h3>📊 Penjualan per Kategori</h3>
        <table>
            <thead>
                <tr>
                    <th>Kategori</th>
                    <th>Total Qty</th>
                    <th>Total Pendapatan</th>
                    <th>Persentase</th>
                </tr>
            </thead>
            <tbody>
                @foreach($salesByCategory as $category)
                <tr>
                    <td><strong>{{ $category->kategori }}</strong></td>
                    <td>{{ number_format($category->total_qty) }}</td>
                    <td>Rp {{ number_format($category->total_pendapatan) }}</td>
                    <td>{{ $totalPendapatan > 0 ? number_format($category->total_pendapatan / $totalPendapatan * 100, 1) : 0 }}%</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="section">
        <h3>⭐ Top 10 Menu Terlaris</h3>
        <table>
            <thead>
                <tr>
                    <th>Rank</th>
                    <th>Nama Menu</th>
                    <th>Kategori</th>
                    <th>Harga</th>
                    <th>Total Terjual</th>
                    <th>Total Pendapatan</th>
                </tr>
            </thead>
            <tbody>
                @foreach($topMenus as $index => $menu)
                <tr class="{{ $index < 3 ? 'highlight' : '' }}">
                    <td><strong>{{ $index + 1 }}</strong></td>
                    <td>{{ $menu->nama }}</td>
                    <td>{{ $menu->kategori }}</td>
                    <td>Rp {{ number_format($menu->harga) }}</td>
                    <td><strong>{{ number_format($menu->total_qty) }}</strong></td>
                    <td><strong>Rp {{ number_format($menu->total_pendapatan) }}</strong></td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="section">
        <h3>💳 Metode Pembayaran</h3>
        <table>
            <thead>
                <tr>
                    <th>Metode</th>
                    <th>Total Transaksi</th>
                    <th>Total Pendapatan</th>
                    <th>Persentase</th>
                </tr>
            </thead>
            <tbody>
                @foreach($paymentMethods as $method)
                <tr>
                    <td><strong>{{ ucfirst($method->metode_pembayaran) }}</strong></td>
                    <td>{{ number_format($method->total_transaksi) }}</td>
                    <td>Rp {{ number_format($method->total_pendapatan) }}</td>
                    <td>{{ $totalPendapatan > 0 ? number_format($method->total_pendapatan / $totalPendapatan * 100, 1) : 0 }}%</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="section">
        <h3>📅 Penjualan Harian</h3>
        <table>
            <thead>
                <tr>
                    <th>Tanggal</th>
                    <th>Total Transaksi</th>
                    <th>Total Pendapatan</th>
                    <th>Rata-rata</th>
                </tr>
            </thead>
            <tbody>
                @foreach($dailySales as $sale)
                <tr>
                    <td>{{ \Carbon\Carbon::parse($sale->date)->format('d M Y') }}</td>
                    <td>{{ number_format($sale->total_transaksi) }}</td>
                    <td>Rp {{ number_format($sale->total_pendapatan) }}</td>
                    <td>Rp {{ number_format($sale->total_transaksi > 0 ? $sale->total_pendapatan / $sale->total_transaksi : 0) }}</td>
                </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <td>TOTAL</td>
                    <td>{{ number_format($totalTransaksi) }}</td>
                    <td>Rp {{ number_format($totalPendapatan) }}</td>
                    <td>Rp {{ number_format($rataRataTransaksi) }}</td>
                </tr>
            </tfoot>
        </table>
    </div>

    <div class="footer">
        <p>Dokumen ini dicetak secara otomatis dari sistem Kopi Paste</p>
        <p>© {{ date('Y') }} Kopi Paste - All Rights Reserved</p>
    </div>
</body>
</html>
