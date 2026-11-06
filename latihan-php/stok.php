<?php

$barang = [
    ['nama' => 'Mouse USB', 'stok' => 12, 'harga' => 75000],
    ['nama' => 'Kertas A4', 'stok' => 40, 'harga' => 55000],
    ['nama' => 'Spidol', 'stok' => 3, 'harga' => 12000],
    ['nama' => 'Flashdisk', 'stok' => 2, 'harga' => 90000],
];
$totalNilai = 0;
foreach ($barang as $b) {
    $totalNilai += $b['stok'] * $b['harga'];
}
echo 'Total: Rp '
    .number_format($totalNilai, 0, ',', '.')."\n";

// 1. saring: hanya stok 5 ke bawah
$hampirHabis = array_filter(
    $barang,
    fn ($b) => $b['stok'] <= 5
);
echo "Hampir habis:\n";
foreach ($hampirHabis as $b) {
    echo "- {$b['nama']} (sisa {$b['stok']})\n";
}
// 2. urutkan: harga termahal di atas
usort(
    $barang,
    fn ($a, $b) => $b['harga'] <=> $a['harga']
);
