# SIMPEG – Sistem Informasi Manajemen Pegawai

**SIMPEG (Sistem Informasi Manajemen Pegawai)** merupakan aplikasi berbasis web yang dikembangkan untuk membantu pengelolaan data pegawai secara terstruktur. Sistem ini menyediakan fitur pengelolaan data pegawai, dashboard statistik, serta manajemen akun pengguna dengan pembagian hak akses berdasarkan role.

## Fitur Utama

### 1. Autentikasi dan Hak Akses
- Login dan logout pengguna.
- Pembagian hak akses Superadmin dan Admin.
- Pembatasan akses halaman berdasarkan role.

### 2. Manajemen Pegawai
- Menambahkan data pegawai.
- Melihat daftar dan detail pegawai.
- Mengubah data pegawai.
- Menghapus data pegawai dengan konfirmasi.
- Pencarian data pegawai.

### 3. Dashboard
- Informasi total pegawai.
- Statistik jumlah pegawai laki-laki dan perempuan.
- Grafik perbandingan jenis kelamin.
- Grafik berdasarkan pendidikan terakhir.
- Grafik distribusi usia pegawai.
- Grafik berdasarkan jabatan.
- Informasi total Admin khusus Superadmin.

### 4. Manajemen Admin
- Menambahkan akun Admin.
- Melihat daftar Admin.
- Mengubah data Admin.
- Menghapus akun Admin.
- Reset password Admin oleh Superadmin.

### 5. Manajemen Profil
- Melihat informasi profil pengguna.
- Mengubah nama dan email.
- Mengubah password.

### 6. Penanganan Error
- Halaman 403 – Akses Ditolak.
- Halaman 404 – Halaman Tidak Ditemukan.

## Teknologi yang Digunakan

| Teknologi | Kegunaan |
|---|---|
| PHP 8.2+ | Bahasa pemrograman backend |
| Laravel 12 | Framework backend |
| MySQL | Database |
| Bootstrap 5 | Framework antarmuka |
| JavaScript | Interaktivitas frontend |
| Chart.js | Visualisasi grafik statistik |
| SweetAlert2 | Notifikasi dan konfirmasi |
| Bootstrap Icons | Ikon antarmuka |

## Persyaratan Sistem

Pastikan perangkat telah memiliki:
- PHP 8.2 atau lebih baru.
- Composer.
- MySQL.
- Node.js dan NPM.
- Git.

## Instalasi dan Konfigurasi

### 1. Clone Repository

```bash
git clone https://github.com/ArilPopon/SistemInformasiManajemenDataPegawai.git
```

Masuk ke direktori project:

```bash
cd SistemInformasiManajemenDataPegawai
```

### 2. Install Dependencies

Install dependency PHP:

```bash
composer install
```

Install dependency frontend:

```bash
npm install
```

### 3. Konfigurasi Environment

Salin file `.env.example` menjadi `.env`:

```bash
cp .env.example .env
```

Untuk Windows CMD, bisa menggunakan:

```cmd
copy .env.example .env
```

Generate application key:

```bash
php artisan key:generate
```

### 4. Konfigurasi Database

Buat database MySQL dengan nama:

```text
db_manajemen_pegawai
```

Kemudian sesuaikan konfigurasi database pada file `.env`:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=db_manajemen_pegawai
DB_USERNAME=root
DB_PASSWORD=
```

Sesuaikan username dan password MySQL dengan konfigurasi perangkat masing-masing.

### 5. Migrasi dan Seeder

Jalankan migrasi database beserta seeder:

```bash
php artisan migrate --seed
```

Seeder akan membuat akun awal Superadmin sesuai konfigurasi pada `SuperadminSeeder`.

### 6. Akun Superadmin Default

Setelah menjalankan proses migrasi dan seeder, sistem akan membuat akun Superadmin secara otomatis melalui `SuperadminSeeder`.

Berikut kredensial akun Superadmin:

| Keterangan | Informasi |
|---|---|
| Nama | Super Administrator |
| Email | `superadmin@gmail.com` |
| Password | `SuperAdmin123!` |
| Role | Superadmin |

**Catatan:**
- Akun Superadmin dibuat secara otomatis ketika menjalankan seeder.
- Gunakan akun tersebut untuk login pertama kali.
- Superadmin dapat membuat dan mengelola akun Admin melalui menu Manajemen Admin.
- Disarankan mengganti password default setelah login pertama kali.
- Jangan gunakan password default untuk deployment produksi.

### 7. Menjalankan Aplikasi

Jalankan server Laravel:

```bash
php artisan serve
```

Jalankan frontend development server:

```bash
npm run dev
```

Buka aplikasi melalui browser:

```text
http://127.0.0.1:8000
```

## Struktur Hak Akses

| Role | Hak Akses |
|---|---|
| Superadmin | Dashboard, manajemen pegawai, manajemen admin, dan profil |
| Admin | Dashboard, manajemen pegawai, dan profil |

Akun Admin dibuat dan dikelola oleh Superadmin. Sistem tidak menyediakan registrasi akun secara publik.

## Keamanan

- Password disimpan menggunakan hashing.
- Validasi dilakukan pada input pengguna.
- Middleware digunakan untuk membatasi akses berdasarkan role.
- Penghapusan data memerlukan konfirmasi.
- File `.env` tidak disertakan dalam repository.

## Pengembang

**Aril Ponco Nugroho**

Project: Sistem Informasi Manajemen Pegawai (SIMPEG)

Framework: Laravel 12

---

*SIMPEG – Sistem Informasi Manajemen Pegawai*
