# LAPORINFRA

LAPORINFRA adalah aplikasi web pelaporan kerusakan dan permasalahan infrastruktur yang menghubungkan masyarakat dengan Organisasi Perangkat Daerah (OPD) yang menangani kategori laporan tertentu.

Aplikasi ini dikembangkan menggunakan Laravel dan mendukung proses pelaporan, penanganan oleh OPD, pembaruan progress, foto progress, lokasi berbasis peta, serta pemantauan history laporan.

> **Status:** Fitur utama aplikasi telah selesai diimplementasikan dan diuji. Project berada pada tahap finalisasi.

---

## Daftar Isi

- [Gambaran Umum](#gambaran-umum)
- [Fitur Utama](#fitur-utama)
- [Role dan Hak Akses](#role-dan-hak-akses)
- [Teknologi](#teknologi)
- [Quick Setup](#quick-setup)
- [Instalasi Manual](#instalasi-manual)
- [Konfigurasi Environment](#konfigurasi-environment)
- [Google OAuth](#google-oauth)
- [Database](#database)
- [Storage Foto](#storage-foto)
- [Menjalankan Aplikasi](#menjalankan-aplikasi)
- [Pengujian](#pengujian)
- [Struktur Project](#struktur-project)
- [Catatan Keamanan](#catatan-keamanan)
- [Status Project](#status-project)

---

## Gambaran Umum

Alur utama LAPORINFRA:

```text
Masyarakat
    │
    │ membuat laporan
    ▼
Pilih kategori
    │
    │ sistem mencari OPD terkait
    ▼
OPD yang menangani kategori
    │
    │ memperbarui status & progress
    ▼
History laporan
    │
    ▼
Masyarakat memantau perkembangan
```

Satu kategori dapat ditangani oleh beberapa OPD. Karena itu, satu laporan dapat terlihat oleh beberapa OPD yang menangani kategori tersebut.

---

## Fitur Utama

### Masyarakat

- Registrasi dan login dengan email/password.
- Login dengan Google.
- Membuat laporan kerusakan infrastruktur.
- Upload foto lokasi.
- Menentukan lokasi melalui peta interaktif.
- Menggunakan lokasi perangkat melalui geolocation browser.
- Memilih titik lokasi secara manual pada peta.
- Menyimpan latitude dan longitude laporan.
- Melihat daftar laporan milik sendiri.
- Melihat detail laporan.
- Melihat status dan progress terbaru.
- Melihat history perkembangan laporan.
- Melihat foto progress terbaru dan foto progress sebelumnya.

### OPD

- Login menggunakan NIP/password.
- Login menggunakan Google.
- Melihat laporan berdasarkan kategori yang ditangani OPD.
- Beberapa OPD dapat melihat laporan yang sama melalui relasi kategori.
- Melihat detail laporan.
- Melihat history pembaruan dari OPD lain.
- Memperbarui status laporan.
- Memperbarui keterangan progress.
- Upload foto progress.
- Preview foto progress sebelum dikirim.
- Melihat grafik statistik laporan.

### Admin

- Login menggunakan Google.
- Dashboard administrator.
- Mengelola akun pengguna.
- Mengelola data OPD/devisi.
- Mengelola kategori laporan.
- Mengatur OPD yang menangani kategori melalui relasi many-to-many.
- Melihat seluruh laporan.
- Melihat detail dan history laporan.
- Bersifat **read-only** terhadap perubahan status/progress laporan.

---

## Role dan Hak Akses

| Role | Login | Hak utama |
|---|---|---|
| `masyarakat` | Email/password atau Google | Membuat dan memantau laporan sendiri |
| `opd` | NIP/password atau Google | Melihat dan memperbarui laporan sesuai kategori yang ditangani |
| `admin` | Google | Mengelola data pendukung dan memantau laporan |

Nilai role pada database:

```text
admin
opd
masyarakat
```

Pada source code, istilah internal **devisi** masih digunakan pada beberapa nama seperti `Devisi.php`, `id_devisi`, dan folder controller `Devisi/`. Pada tampilan aplikasi digunakan istilah **OPD**.

---

## Teknologi

| Komponen | Teknologi |
|---|---|
| Framework | Laravel 13 |
| Bahasa | PHP 8.3+ |
| Database | MySQL / MariaDB |
| Template | Blade |
| Asset bundler | Vite |
| Grafik | Chart.js |
| Peta | Leaflet + OpenStreetMap |
| OAuth | Laravel Socialite + Google |
| API foundation | Laravel Sanctum |
| Dependency PHP | Composer |
| Dependency frontend | NPM |
| Version control | Git + GitHub |

---

## Quick Setup

LAPORINFRA menyediakan **quick setup** melalui Composer Script. Setelah repository di-clone dan dependency PHP di-install, sebagian besar proses persiapan project dapat dijalankan dengan **satu perintah**.

### 1. Clone repository

```bash
git clone https://github.com/fadlyproduktif-gif/LaporInfra.git
cd LaporInfra
```

### 2. Install Composer dependency

```bash
composer install
```

### 3. Jalankan quick setup

```bash
composer run setup
```

Command tersebut menjalankan proses berikut secara berurutan:

```text
.env check / creation
        ↓
Generate application key
        ↓
Migration + seeder
        ↓
npm install
        ↓
Storage link
        ↓
Vite production build
```

Composer mendukung custom scripts di `composer.json` dan menjalankan command dalam array sesuai urutan yang didefinisikan. 

> **Catatan:** quick setup tidak mengisi credential Google OAuth atau mengganti konfigurasi database yang sudah ada. Konfigurasi tersebut tetap dilakukan melalui `.env`.

---

## Instalasi Manual

Apabila ingin menjalankan setiap langkah secara manual, gunakan urutan berikut:

### Buat `.env`

Linux/macOS:

```bash
cp .env.example .env
```

Windows PowerShell:

```powershell
Copy-Item .env.example .env
```

### Generate application key

```bash
php artisan key:generate
```

### Buat database

Buat database MySQL/MariaDB dengan nama:

```text
lapinfra
```

Sesuaikan konfigurasi pada `.env`.

### Migration dan seeder

```bash
php artisan migrate --seed
```

Untuk membangun ulang database dari nol:

```bash
php artisan migrate:fresh --seed
```

### Storage

```bash
php artisan storage:link
```

### Frontend

```bash
npm install
npm run build
```

---

## Konfigurasi Environment

Contoh database:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=lapinfra
DB_USERNAME=root
DB_PASSWORD=
```

Google OAuth:

```env
GOOGLE_CLIENT_ID=
GOOGLE_CLIENT_SECRET=
GOOGLE_REDIRECT_URI=http://127.0.0.1:8000/auth/google/callback
```

Jangan commit file `.env` ke repository.

---

## Google OAuth

LAPORINFRA menggunakan Laravel Socialite untuk autentikasi Google.

Authorized Redirect URI pada environment lokal:

```text
http://127.0.0.1:8000/auth/google/callback
http://127.0.0.1:8000/auth/google/masyarakat/callback
http://127.0.0.1:8000/auth/google/opd/callback
```

Alur login:

```text
Admin       → /auth/google         → Google → /auth/google/callback
Masyarakat  → /auth/google/masyarakat → Google → /auth/google/masyarakat/callback
OPD         → /auth/google/opd     → Google → /auth/google/opd/callback
```

Credential Google harus disimpan pada `.env` dan tidak boleh dimasukkan ke repository.

---

## Database

Tabel utama:

```text
devisi
users
kategori
kategori_devisi
status_laporan
laporan
history_laporan
cache
jobs
personal_access_tokens
```

### Relasi kategori dan OPD

```text
kategori
    ↕
kategori_devisi
    ↕
devisi
```

Relasi ini memungkinkan:

- satu kategori ditangani banyak OPD;
- satu OPD menangani banyak kategori.

### Relasi history laporan

`laporan` menyimpan kondisi terkini, sedangkan `history_laporan` menyimpan snapshot kondisi sebelum update.

```text
Kondisi lama
    ↓
history_laporan
    ↓
Kondisi terbaru
    ↓
laporan
```

History mencatat status sebelumnya, keterangan progress sebelumnya, foto progress sebelumnya, user yang melakukan perubahan, serta waktu perubahan.

---

## Storage Foto

Foto laporan dan foto progress menggunakan filesystem public Laravel.

Contoh lokasi:

```text
storage/app/public/laporan
```

Buat symbolic link dengan:

```bash
php artisan storage:link
```

Direktori hasil generate seperti `storage/` dan `public/storage/` tidak perlu dimasukkan ke Git.

---

## Menjalankan Aplikasi

Server Laravel:

```bash
php artisan serve
```

Aplikasi:

```text
http://127.0.0.1:8000
```

Untuk development frontend:

```bash
npm run dev
```

---

## Pengujian

Pengujian akhir yang telah dilakukan:

### Composer

```bash
composer validate
```

Hasil: `composer.json is valid`.

### Quick setup

```bash
composer run setup
```

Hasil: seluruh langkah setup berhasil dijalankan.

### Database

```bash
php artisan migrate:fresh --seed
```

Hasil: migration dan seeder berhasil.

### Frontend

```bash
npm run build
```

Hasil: build berhasil. Terdapat warning opsional terkait package `fontaine`, tetapi tidak menyebabkan build gagal.

### Fitur utama

```text
✅ Login/autentikasi
✅ Google OAuth
✅ Pembuatan laporan
✅ Upload foto lokasi
✅ Preview foto
✅ Pemilihan lokasi pada peta
✅ Penyimpanan latitude & longitude
✅ Tampilan marker lokasi
✅ Relasi kategori ↔ banyak OPD
✅ Laporan terlihat oleh OPD terkait
✅ Update status laporan
✅ Update keterangan progress
✅ Upload foto progress
✅ Preview foto progress
✅ Penyimpanan history
✅ Identitas user/OPD pengubah
✅ Foto progress sebelumnya pada history
✅ History pada masyarakat
✅ History pada OPD
✅ History pada admin
✅ Admin read-only pada laporan
✅ Pengelolaan kategori dan OPD
```

---

## Struktur Project

```text
LaporInfra/
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── Admin/
│   │   │   ├── Auth/
│   │   │   ├── Devisi/
│   │   │   └── Masyarakat/
│   │   └── Middleware/
│   └── Models/
├── database/
│   ├── migrations/
│   └── seeders/
├── resources/
│   ├── css/
│   ├── js/
│   └── views/
├── routes/
│   ├── api.php
│   ├── console.php
│   └── web.php
├── storage/
├── tests/
├── composer.json
├── package.json
└── vite.config.js
```

---

## Catatan Keamanan

- Jangan commit `.env`.
- Jangan memasukkan Google Client Secret ke source code atau README.
- Jangan menyimpan credential database produksi di repository.
- Quick setup tidak menyimpan credential rahasia di repository.

---

## Status Project

**Tahap: finalisasi.**

Fitur utama yang diminta telah selesai:

```text
Many-to-many kategori ↔ OPD        ✅
Kolaborasi penanganan laporan       ✅
History progress                    ✅
Foto progress                       ✅
Lokasi + koordinat                  ✅
Peta interaktif                     ✅
Admin category management           ✅
Admin read-only laporan              ✅
Quick setup automation               ✅
Testing migration + seeder          ✅
Testing frontend build              ✅
```

Tahap berikutnya berfokus pada final audit, dokumentasi, screenshot/presentasi, dan finalisasi Git.

---

## Referensi

- [Laravel](https://laravel.com/docs)
- [Composer Scripts](https://getcomposer.org/doc/articles/scripts.md)
- [Laravel Socialite](https://laravel.com/docs/socialite)
- [Leaflet](https://leafletjs.com/)
- [OpenStreetMap](https://www.openstreetmap.org/)
