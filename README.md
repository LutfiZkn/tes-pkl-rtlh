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
2. Generate APP_KEY
   `php artisan key:generate`
3. Jalankan migration dan seeder
   `php artisan migrate --seed`
4. Buat storage link
   `php artisan storage:link`

## STORAGE
Foto rumah menggunakan Laravel Storage.
Setelah instalasi project, jalankan:
`php artisan storage:link` (Poin no. 4 di langkah mengatur koneksi db)
command tsb diperlukan agar foto yang diunggah dapat ditampilkan pada aplikasi

## AKUN DEMO
### Admin
- Username: admin
- Password: admin123
- Role: Admin

### Petugas
- Username: petugas
- Password: petugas123
- Role: Petugas

## CARA MENJALANKAN APLIKASI
1. Jalankan Perintah Berikut di Terminal Project
   `php artisan serve`
2. Nyalakan Local Server
3. Buka Melalui Browser/Buka Langsung Dari Local Server
4. Login Dengan User dan Password (bisa menggunakan akun demo)

## DAFTAR FITUR YANG SUDAH DIBUAT DAN BELUM
1. CRUD untuk Form Rumah
2. CRUD untuk Form Kecamatan
3. CRUD untuk Form Kelurahan
4. CRUD untuk Form Pengguna/User
5. Sistem Login dan Autentikasi
6. Hak Akses Admin dan Petugas
7. Bar Pencarian Data Rumah
8. Tombol Reset Pencarian
9. Filter Berdasarkan Kondisi
10. Filter Berdasarkan Kelurahan
11. Filter Berdasarkan Kecamatan
12. Filter Berdasarkan Tahun Pendataan
13. Filter Berdasarkan Status Verifikasi
14. Sorting (filter) Data Rumah
15. Ringkasan Statistik Data Rumah (Semua, dan Berdasarkan Kerusakan)
16. Pagination
17. Badge Kondisi (Hijau: ringan, Kuning: sedang, Merah: Berat)
18. Upload Foto Rumah
19. Hapus Foto Rumah
20. Verifikasi Data Rumah
21. Dashboard
22. Peta Sebaran Rumah
23. Latitude & Longitude Rumah
24. Export Data ke Excel dan PDF
25. Export mengikuti filter aktif (berdasarkan sorting)
26. Soft Delete/Sampah
27. Restore Data Rumah Yang Ada di Soft Delete/Sampah
28. Histori/Riwayat Kondisi Rumah
29. Validasi Penghapusan Kecamatan & Kelurahan

## Bagian Yang Dibantu Oleh Kecerdasan Buatan (AI)
- Membantu pengembangan dan perbaikan CRUD data rumah
- Membantu implementasi validasi dan relasi data
- Membantu pengembangan fitur upload dan penghapusan foto
- Membantu pembuatan peta dan koordinat rumah
- Membantu pengembangan fitur export
- Membantu beberapa perbaikan error selama pengembangan
