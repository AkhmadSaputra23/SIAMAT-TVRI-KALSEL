# Project Setup: SIAMAT TVRI Kalsel

## Deskripsi
Inisialisasi dan setup awal project untuk aplikasi SIAMAT (Sistem Informasi Manajemen Aset TVRI Kalsel).

## Spesifikasi Teknis
- **Framework**: Laravel 12.68
- **Database**: MySQL

## Langkah Implementasi (High-Level)
1. **Pembuatan Project**: Lakukan instalasi framework Laravel versi 12.68 di direktori root repositori ini.
2. **Konfigurasi Lingkungan (.env)**: Sesuaikan file `.env` untuk menggunakan driver database MySQL (konfigurasi `DB_CONNECTION`, `DB_HOST`, `DB_PORT`, `DB_DATABASE`, `DB_USERNAME`, `DB_PASSWORD`).
3. **Koneksi Database**: Pastikan koneksi ke database MySQL berhasil dilakukan dan siap digunakan untuk migration.
4. **Pengujian Awal (Sanity Check)**: Jalankan local development server (`php artisan serve`) untuk memastikan instalasi Laravel berjalan dengan baik tanpa error.

*Catatan: Dokumen ini ditujukan untuk diimplementasikan oleh programmer atau agent selanjutnya.*
