## APLIKASI PENDATAAN KONDISI RUMAH
Aplikasi Pendataan Kondisi Rumah adalah Aplikasi yang dimaksudkan dan ditujukan agar pengelolaan data untuk rumah yang kurang/tidak layak menjadi lebih mudah dan lebih akurat.

## REQUIREMENT UTAMA (Versi PHP, Laravel, dan Database)
```
Versi PHP yang digunakan: 8.5.8
Versi Laravel yang digunakan: 13.8
Database yang digunakan: Laragon/phpMyAdmin
```

## LANGKAH INSTALASI PROJECT
1. Clone Repository
   `git clone https://github.com/LutfiZkn/tes-pkl-rtlh`
4. Masuk Ke Folder Project
   `cd tes-pkl-rtlh`
3. Install Seluruh Depedency Laravel
   `composer install`
4. Salin File Konfigurasi
   `cp .env.example .env`

## LANGKAH MENGATUR KONEKSI DATABASE
1. Ubah Konfigurasi Database, contoh:
   ```
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=tes_pkl_rtlh
   DB_USERNAME=root
   DB_PASSWORD=
   ```
2. Generate APP_KEY untuk .env
   `php artisan key:generate`
3. Jalankan Migration
   `php artisan migrate`
4. Jalankan Seeder
   `php artisan migrate:fresh --seed`

## CARA MENJALANKAN APLIKASI
1. Jalankan Perintah Berikut di Terminal Project
   `php artisan serve`
2. Nyalakan Local Server
3. Buka Melalui Browser/Buka Langsung Dari Local Server

## DAFTAR FITUR YANG SUDAH DIBUAT DAN BELUM
1. CRUD untuk Form Rumah
2. CRUD untuk Form Kecamatan
3. CRUD untuk Form Kelurahan
4. Bar Pencarian
5. Filter Berdasarkan Kondisi
6. Filter Berdasarkan Kelurahan
7. Ringkasan Jumlah Rumah (Semua, dan Berdasarkan Kerusakan)
8. Pagination
9. Badge Kondisi (Hijau: ringan, Kuning: sedang, Merah: Berat)
10. Tombol Reset Pencarian
Belum Dibuat:
1. Soft Delete

## Bagian Yang Dibantu Oleh Kecerdasan Buatan (AI)
- Create dan Update untuk Rumah
