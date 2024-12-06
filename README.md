# Sistem Reset Password (Forgot Password)

Ini adalah sistem reset password berbasis PHP yang memungkinkan pengguna untuk mereset password mereka dengan memverifikasi OTP (One Time Password) yang dikirimkan melalui email. Sistem ini menggunakan PHP Mailer untuk mengirimkan OTP ke email pengguna.

## Struktur Proyek


## Cara Penggunaan

1. **Siapkan Database**  
   Pastikan Anda sudah menyiapkan database MySQL dengan tabel `users` yang memiliki field berikut:
   - `email` (VARCHAR): Alamat email pengguna.
   - `password` (VARCHAR): Password pengguna yang sudah di-hash.
   - `otp` (VARCHAR): OTP yang dihasilkan untuk pengguna.
   - `otp_created_at` (DATETIME): Waktu pembuatan OTP.

2. **Konfigurasi Database**  
   Buka file `config/database.php` dan sesuaikan koneksi database Anda dengan mengubah host, username, password, dan nama database.

3. **Instalasi Dependensi**  
   Jika Anda belum menginstal dependensi yang diperlukan, buka terminal dan arahkan ke folder proyek, kemudian jalankan perintah berikut:
   ```bash
   composer install
