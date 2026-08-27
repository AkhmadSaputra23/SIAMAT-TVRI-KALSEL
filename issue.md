# Fitur Registrasi User API

## Deskripsi Tugas
Tugas ini adalah menyiapkan tabel `users` di database dan membuat endpoint API untuk melakukan registrasi user baru. Instruksi di bawah ini disiapkan secara runut agar mudah diimplementasikan.

## Spesifikasi Database
Tabel: `users`
Kolom yang dibutuhkan:
- `id` : integer, primary key, auto increment
- `name` : varchar(255), not null
- `email` : varchar(255), not null, unique
- `password` : varchar(255), not null (akan diisi dengan nilai hash dari bcrypt)
- `created_at` : timestamp, default current_timestamp

*(Catatan: Kamu bisa memodifikasi file migration default `users` bawaan Laravel atau membuat migration baru jika diperlukan. Pastikan tabel di database sesuai dengan struktur ini).*

## Spesifikasi API

- **Method**: `POST`
- **Endpoint**: `/api/users`

**Request Body (JSON):**
```json
{
    "name": "eko",
    "email": "eko@localhost",
    "password": "rahasia"
}
```

**Response Body (Sukses):**
```json
{
    "data": "OK"
}
```

**Response Body (Error - Jika email sudah ada):**
```json
{
    "error": "Email sudah terdaftar"
}
```

---

## Tahapan Implementasi (Panduan Pengerjaan)

1. **Pembuatan / Penyesuaian Migration & Model**
   - Buka direktori `database/migrations` dan cari file migration untuk tabel `users` (atau buat baru dengan `php artisan make:migration create_users_table`).
   - Sesuaikan kolom migration agar sama persis dengan spesifikasi database di atas. (Ingat untuk menambahkan `->unique()` pada kolom `email`).
   - Eksekusi `php artisan migrate` (atau `php artisan migrate:fresh` jika perlu mengulang) untuk membuat tabel di MySQL.
   - Buka model `app/Models/User.php`. Pastikan array `$fillable` memiliki value `['name', 'email', 'password']` agar data bisa disimpan secara mass-assignment.

2. **Inisialisasi Routing API**
   - Pada Laravel terbaru, routing API mungkin belum aktif secara default. Jalankan perintah `php artisan install:api` di terminal.
   - Perintah ini akan membuat file `routes/api.php` jika belum ada.

3. **Pembuatan Controller**
   - Buat Controller baru dengan menjalankan perintah: `php artisan make:controller Api/UserController`
   - Buka file `app/Http/Controllers/Api/UserController.php` yang baru saja terbuat.
   - Buat sebuah fungsi public baru dengan nama `register(Request $request)`.

4. **Penulisan Logika di dalam Controller**
   - Di dalam method `register`, ambil data `email` dari `$request` dan cek menggunakan query (misalnya `User::where('email', $request->email)->first()`).
   - **Jika user dengan email tersebut sudah ditemukan:** 
     Berikan response JSON `{"error": "Email sudah terdaftar"}` dengan status code HTTP 400 (Bad Request).
   - **Jika email belum terdaftar:**
     - Ambil input `password` dan lakukan hashing menggunakan `bcrypt($request->password)`.
     - Simpan data (name, email, password yang sudah di-hash) ke tabel `users` menggunakan model `User::create(...)`.
     - Kembalikan response JSON `{"data": "OK"}` dengan status code HTTP 200 atau 201.

5. **Mendaftarkan Endpoint di Route**
   - Buka file `routes/api.php`.
   - Tambahkan baris kode berikut untuk mendaftarkan endpoint:
     `Route::post('/users', [UserController::class, 'register']);`
     *(Jangan lupa meng-import namespace `UserController` di bagian atas file).*

6. **Pengujian Internal**
   - Jalankan web server lokal dengan `php artisan serve`.
   - Gunakan aplikasi klien REST seperti Postman, Insomnia, atau cURL.
   - Tembak endpoint `POST http://127.0.0.1:8000/api/users` dengan JSON body sesuai contoh.
   - Verifikasi apakah respons ketika sukses dan error sudah tepat seperti spesifikasi.
