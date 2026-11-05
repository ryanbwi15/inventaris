<?php
// Fungsi Konversi Nilai
function konversiNilai(float $nilai): string
{
    // Jika Nilai kurang dari 0 atau lebih dari 100, maka ditolak/tidak valid
    if ($nilai < 0 || $nilai > 100) {
        return "tidak valid";
    } elseif ($nilai >= 85) {
        return "A";
    } elseif ($nilai >= 70) {
        return "B";
    } elseif ($nilai >= 55) {
        return "C";
    } else {
        return "D";
    }
}
echo "Hasil Konversi Nilai : \n";
echo "Nilai 90 : " . konversiNilai(90), "\n";  // A
echo "Nilai 85 : " . konversiNilai(85), "\n";  // B
echo "Nilai 70 : " . konversiNilai(70), "\n";  // C
echo "Nilai 54 : " . konversiNilai(54), "\n";  // D
echo "Nilai 101 : " . konversiNilai(101), "\n"; // Nilai tidak valid

// Fungsi Hitung Diskon Belanja
function hitungDiskonBelanja(float $totalBelanja): float
{
    if ($totalBelanja >= 500000) {
        $diskon = 10;
    } elseif ($totalBelanja >= 200000) {
        $diskon = 5;
    } else {
        $diskon = 0;
    }

    $potongan = $totalBelanja * $diskon / 100;
    $totalAkhir = $totalBelanja - $potongan;
    return $totalAkhir;
}
$daftarBelanja = [150000, 200000, 300000, 600000];
echo "\nHasil Total Diskon Belanja:\n";
foreach ($daftarBelanja as $totalBelanja) {
    $totalAkhir = hitungDiskonBelanja($totalBelanja);
    echo "Total Belanja: Rp " . number_format($totalBelanja, 0, ',', '.') . "\n";
    echo "Total Akhir: Rp " . number_format($totalAkhir, 0, ',', '.') . "\n";
    echo "------------------------" . "\n";
}

// Fungsi Nilai Terbesar
function terbesar(array $angka): int
{
    $nilaiTerbesar = $angka[0];
    foreach ($angka as $nilai) {
        if ($nilai > $nilaiTerbesar) {
            $nilaiTerbesar = $nilai;
        }
    }
    return $nilaiTerbesar;
}
// array
$data1 = [7, 21, 3, 15];
$data2 = [-4, -9, -2];
$hasil1 = terbesar($data1);
$hasil2 = terbesar($data2);
echo "\nNilai terbesar dari data array ke 1 adalah " . $hasil1;
echo "\nNilai terbesar dari data array ke 2 adalah " . $hasil2;
