# Buku Manual Aplikasi Inventaris

Aplikasi web untuk mengelola kategori dan persediaan barang. Pengguna yang sudah masuk dapat mengelola data, mencari barang, dan mencetak laporan PDF.

## Persyaratan

- PHP 8.3 atau lebih baru
- Composer
- Database yang didukung Laravel
- Ekstensi PHP yang dibutuhkan Laravel dan DomPDF

## Instalasi Lokal

1. Pasang dependensi PHP:

   ```sh
   composer install
   ```

2. Salin konfigurasi contoh menjadi `.env`. Di Windows Command Prompt:

   ```bat
   copy .env.example .env
   ```

   Jika `.env` sudah ada, jangan menimpanya.

3. Konfigurasikan database pada `.env`. Konfigurasi contoh memakai SQLite. Buat file databasenya jika belum tersedia:

   ```sh
   php -r "file_exists('database/database.sqlite') || touch('database/database.sqlite');"
   ```

   Jika memakai MySQL atau database lain, atur koneksi yang sesuai pada `.env`.

4. Buat application key, lalu siapkan tabel dan data contoh:

   ```sh
   php artisan key:generate
   php artisan migrate --seed
   ```

   Seeder membuat dua kategori contoh, dua barang, dan akun berikut:

   | Email | Password |
   | --- | --- |
   | `admin@inventaris.test` | `password` |

   Kredensial ini hanya untuk pengembangan lokal. Jangan gunakan akun atau password tersebut di produksi.

5. Siapkan penyimpanan foto dan jalankan server:

   ```sh
   php artisan storage:link
   php artisan serve
   ```

6. Buka `http://127.0.0.1:8000` dan masuk menggunakan akun demo.

Untuk mengulang database dari awal, jalankan `php artisan migrate:fresh --seed`. **Perintah ini menghapus seluruh data pada database yang terhubung.**

## Panduan Penggunaan

### Masuk dan keluar

- Masukkan email dan password akun yang sudah terdaftar. Centang **Ingat saya** hanya pada perangkat pribadi.
- Gunakan tombol **Keluar** pada navigasi untuk mengakhiri sesi.
- Pendaftaran akun dan reset password belum tersedia.

### Dashboard

Halaman utama menyediakan navigasi menuju data kategori dan barang. Angka ringkasan saat ini masih statis dan belum dihitung dari database.

### Kategori

1. Buka **Kategori**, lalu pilih **Tambah Kategori**.
2. Isi nama kategori. Nama wajib diisi, maksimal 100 karakter, dan harus unik. Deskripsi bersifat opsional.
3. Pilih **Simpan**. Gunakan tombol ubah atau hapus pada daftar untuk mengelola kategori.

**Perhatian:** menghapus kategori juga menghapus semua barang yang terhubung ke kategori tersebut.

### Barang

1. Buka **Barang**, lalu pilih **Tambah Barang**.
2. Pilih kategori dan isi nama barang, stok, serta harga satuan.
3. Stok harus berupa bilangan bulat nol atau lebih. Harga harus bernilai nol atau lebih.
4. Foto bersifat opsional. Saat menambah barang, format yang diterima server adalah JPG/JPEG atau PNG dengan ukuran maksimum 2 MB.
5. Pilih **Simpan**. Dari daftar barang, gunakan tombol ubah untuk memperbarui data dan tombol hapus untuk menghapus barang.

Kolom pencarian menerima nama barang atau nama kategori. Tombol **Cetak PDF** membuat laporan, termasuk filter pencarian yang sedang dipakai. Saat mengubah barang, foto lama tetap digunakan jika foto baru tidak dipilih.

Foto disimpan melalui public storage Laravel. Jika foto tidak tampil, pastikan `php artisan storage:link` sudah dijalankan dan direktori penyimpanan dapat ditulis oleh PHP.

## Keamanan

- Dashboard, kategori, dan barang hanya dapat diakses setelah login.
- Form autentikasi dan perubahan data dilindungi CSRF Laravel.
- Password disimpan dalam bentuk hash.
- Setelah lima percobaan login gagal, percobaan berikutnya dibatasi sementara berdasarkan email dan alamat IP.
- Untuk deployment, gunakan HTTPS, konfigurasi session/cookie yang aman, dan `APP_DEBUG=false`.

## Pengujian

Jalankan seluruh tes aplikasi dengan:

```sh
php artisan test
```

## Teknologi

- Laravel 13 dan PHP 8.3+
- Bootstrap 5
- DomPDF untuk laporan PDF