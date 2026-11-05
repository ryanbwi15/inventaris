<?php
function hitungDiskon(float $harga, float $persen): float
{
    if ($persen < 0 || $persen > 100) {
        return $harga;
    }
    $potongan = $harga * $persen / 100;
    return $harga - $potongan;
}
echo "\nHasil Menghitung Diskon :\n";
echo "Harga Rp. 100.000 setelah diskon 10%:\n";
echo hitungDiskon(100000, 10), "\n"; // 90000
echo "Harga Rp. 100.000 setelah diskon 150%:\n";
echo hitungDiskon(100000, 150), "\n"; // 40000

// FUNGSI MENCARI BARANG
function cariBarang(array $daftarBarang, string $kataKunci): array
{
    $hasil = [];

    foreach ($daftarBarang as $b) {
        if (str_contains(
            strtolower($b['nama']),
            strtolower($kataKunci)
        )) {
            $hasil[] = $b;
        }
    }

    return $hasil;
}

$barang = [
    ['nama' => 'Mouse USB', 'stok' => 12, 'harga' => 75000, 'kategori' => 'Elektronik'],
    ['nama' => 'Kertas A4', 'stok' => 40, 'harga' => 55000, 'kategori' => 'ATK'],
    ['nama' => 'Spidol',  'stok' => 3, 'harga' => 12000, 'kategori' => 'ATK'],
    ['nama' => 'Flashdisk', 'stok' => 2, 'harga' => 90000, 'kategori' => 'Elektronik'],
];

$hasilCari = cariBarang($barang, 'mouse');

echo "\nHasil pencarian barang 'mouse':\n";

foreach ($hasilCari as $b) {
    echo "- {$b['nama']} | Stok: {$b['stok']} | Harga: Rp "
        . number_format($b['harga'], 0, ',', '.') . "\n";
}

function stokPerKategori(array $daftarBarang): array
{
    $hasil = [];
    foreach ($daftarBarang as $b) {
        $kategori = $b['kategori'];
        if (!isset($hasil[$kategori])) {
            $hasil[$kategori] = 0;
        }
        $hasil[$kategori] += $b['stok'];
    }
    return $hasil;
}
echo "\nTotal stok per kategori:\n";
print_r(stokPerKategori($barang));
