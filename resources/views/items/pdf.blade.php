<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Data Barang</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 11px;
            color: #333;
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
        }

        .header h2 {
            margin-bottom: 5px;
            font-size: 18px;
        }

        .header p {
            margin: 0;
            font-size: 11px;
        }

        .info {
            margin-bottom: 12px;
            line-height: 1.6;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            border: 1px solid #999;
            padding: 7px;
        }

        th {
            background-color: #e9ecef;
            text-align: center;
        }

        .center {
            text-align: center;
        }

        .right {
            text-align: right;
        }

        .summary {
            margin-top: 15px;
            width: 55%;
            margin-left: auto;
        }

        .summary td {
            padding: 6px;
        }

        .footer {
            margin-top: 25px;
            text-align: right;
            font-size: 10px;
        }
    </style>
</head>

<body>

    {{-- Header Laporan --}}
    <div class="header">
        <h2>LAPORAN DATA BARANG</h2>
        <p>DATA INVENTARIS BARANG</p>
        <hr>
    </div>

    {{-- Informasi Laporan --}}
    <div class="info">
        <strong>Tanggal Cetak:</strong>
        {{ now()->translatedFormat('d F Y H:i') }} WIB
        <br>

        @if ($search)
            <strong>Kata Pencarian:</strong> {{ $search }}
            <br>
        @endif

        <strong>Jumlah Data:</strong> {{ $item->count() }} barang
    </div>

    {{-- Tabel Barang --}}
    <table>
        <thead>
            <tr>
                <th width="5%">No</th>
                <th width="20%">Kategori</th>
                <th>Nama Barang</th>
                <th width="12%">Stok</th>
                <th width="20%">Harga Satuan</th>
                <th width="20%">Nilai Stok</th>
            </tr>
        </thead>

        <tbody>
            @forelse ($item as $i)
                <tr>
                    <td class="center">{{ $loop->iteration }}</td>
                    <td>{{ $i->category->name }}</td>
                    <td>{{ $i->name }}</td>
                    <td class="center">{{ $i->stock }}</td>
                    <td class="right">
                        Rp {{ number_format($i->price, 0, ',', '.') }}
                    </td>
                    <td class="right">
                        Rp {{ number_format($i->stock * $i->price, 0, ',', '.') }}
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="center">
                        Tidak ada data barang.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>

    {{-- Ringkasan --}}
    <table class="summary">
        <tr>
            <td><strong>Total Stok</strong></td>
            <td class="right">
                {{ number_format($totalStok, 0, ',', '.') }}
            </td>
        </tr>
        <tr>
            <td><strong>Total Nilai Persediaan</strong></td>
            <td class="right">
                <strong>
                    Rp {{ number_format($totalNilai, 0, ',', '.') }}
                </strong>
            </td>
        </tr>
    </table>

    {{-- Footer --}}
    <div class="footer">
        <p>Dicetak melalui Aplikasi Inventaris Barang</p>
    </div>

</body>
</html>