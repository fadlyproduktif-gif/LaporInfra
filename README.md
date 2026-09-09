# LAPORINFRA

LAPORINFRA adalah aplikasi web pelaporan kerusakan dan permasalahan infrastruktur yang menghubungkan masyarakat dengan Organisasi Perangkat Daerah (OPD) yang menangani kategori laporan tertentu.

Aplikasi ini dikembangkan menggunakan Laravel dan dirancang untuk mendukung proses pelaporan, penanganan oleh OPD, pembaruan progress, serta pemantauan riwayat laporan.

> **Status:** Fitur utama aplikasi web telah selesai diimplementasikan dan diuji. Project berada pada tahap finalisasi.

---

## Daftar Isi

- [Gambaran Umum](#gambaran-umum)
- [Fitur Utama](#fitur-utama)
- [Role dan Hak Akses](#role-dan-hak-akses)
- [Teknologi](#teknologi)
- [Arsitektur Alur Laporan](#arsitektur-alur-laporan)
- [Instalasi](#instalasi)
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

Satu laporan dapat ditangani oleh lebih dari satu OPD apabila kategori laporan memiliki beberapa OPD penanggung jawab.

---

## Fitur Utama

### Masyarakat

- Registrasi dan login dengan email/password.
- Login dengan Google.
- Membuat laporan kerusakan infrastruktur.
- Upload foto lokasi.
- Menentukan lokasi melalui peta.
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
- Melihat foto lokasi dan progress.
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
| JavaScript | JavaScript |
| Grafik | Chart.js |
| Peta | Leaflet + OpenStreetMap |
| OAuth | Laravel Socialite + Google |
| API foundation | Laravel Sanctum |
| Dependency PHP | Composer |
| Dependency frontend | NPM |
| Version control | Git + GitHub |

---

## Arsitektur Alur Laporan

### Relasi kategori dan OPD

LAPORINFRA menggunakan relasi **many-to-many** antara kategori dan OPD:

```text
kategori
    ↕
kategori_devisi
    ↕
devisi
```

Artinya:

- satu kategori dapat ditangani banyak OPD;
- satu OPD dapat menangani banyak kategori.

Masyarakat cukup memilih kategori. Sistem menentukan OPD berdasarkan relasi pada tabel pivot `kategori_devisi`.

### History laporan

Tabel `laporan` menyimpan kondisi **terkini**, sedangkan `history_laporan` menyimpan kondisi **sebelum update**.

```text
Sebelum update
      ↓
history_laporan
      ↓
Kondisi terbaru
      ↓
laporan
```

Saat OPD melakukan update, kondisi lama disimpan terlebih dahulu ke history bersama user yang melakukan perubahan. Dengan demikian perkembangan laporan dapat dilihat kembali dan identitas OPD/user pengubah tetap terlacak.

### Lokasi

Form laporan menggunakan Leaflet dan OpenStreetMap. Lokasi dapat diperoleh dari geolocation browser atau dipilih secara manual.

Koordinat disimpan pada:

```text
laporan.latitude
laporan.longitude
```

### Foto progress

OPD dapat mengirim foto kondisi terbaru. Foto lama dipertahankan pada history saat terjadi update berikutnya.

```text
laporan.foto_progress   → foto kondisi terbaru
history_laporan.history_foto → foto kondisi sebelumnya
```

---

## Instalasi

### 1. Clone repository

```bash
git clone https://github.com/fadlyproduktif-gif/LaporInfra.git
cd LaporInfra
```

### 2. Install dependency

```bash
composer install
npm install
```

### 3. Buat file `.env`

Linux/macOS:

```bash
cp .env.example .env
```

Windows PowerShell:

```powershell
Copy-Item .env.example .env
```

### 4. Generate application key

```bash
php artisan key:generate
```

### 5. Buat database

Buat database MySQL/MariaDB dengan nama:

```text
lapinfra
```

Sesuaikan konfigurasi database pada `.env`.

### 6. Jalankan migration dan seeder

```bash
php artisan migrate --seed
```

Untuk membangun ulang database dari nol:

```bash
php artisan migrate:fresh --seed
```

> Perintah `migrate:fresh` akan menghapus tabel dan data pada database yang dipilih.

### 7. Buat symbolic link storage

```bash
php artisan storage:link
```

### 8. Build asset frontend

```bash
npm run build
```

---

## Konfigurasi Environment

Contoh konfigurasi database:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=lapinfra
DB_USERNAME=root
DB_PASSWORD=
```

Konfigurasi Google OAuth:

```env
GOOGLE_CLIENT_ID=
GOOGLE_CLIENT_SECRET=
GOOGLE_REDIRECT_URI=http://127.0.0.1:8000/auth/google/callback
```

Jangan commit file `.env` ke repository.

---

## Google OAuth

LAPORINFRA menggunakan Laravel Socialite untuk autentikasi Google.

Authorized Redirect URI yang digunakan pada environment lokal:

```text
http://127.0.0.1:8000/auth/google/callback
http://127.0.0.1:8000/auth/google/masyarakat/callback
http://127.0.0.1:8000/auth/google/opd/callback
```

Alur login:

```text
Admin
  ↓
/auth/google
  ↓
Google
  ↓
/auth/google/callback
```

```text
Masyarakat
  ↓
/auth/google/masyarakat
  ↓
Google
  ↓
/auth/google/masyarakat/callback
```

```text
OPD
  ↓
/auth/google/opd
  ↓
Google
  ↓
/auth/google/opd/callback
```

Credential Google harus disimpan pada `.env` dan tidak boleh dimasukkan ke repository.

---

## Database

Tabel utama project:

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

### Relasi utama

```text
User
 ├── belongsTo Devisi
 └── hasMany Laporan

Devisi
 ├── belongsToMany Kategori
 └── hasMany User

Kategori
 ├── belongsToMany Devisi
 └── hasMany Laporan

Laporan
 ├── belongsTo User
 ├── belongsTo Kategori
 ├── belongsTo StatusLaporan
 └── hasMany HistoryLaporan

HistoryLaporan
 ├── belongsTo Laporan
 ├── belongsTo User sebagai userPengubah
 └── belongsTo StatusLaporan
```

### Tabel `kategori_devisi`

Digunakan sebagai pivot many-to-many antara kategori dan OPD.

```text
id_kategori_devisi
id_kategori
id_devisi
created_at
updated_at
```

Terdapat unique constraint pada pasangan:

```text
id_kategori + id_devisi
```

### Tabel `laporan`

Menyimpan data terkini, termasuk:

```text
id_laporan
id_user
nama_laporan
deskripsi
lokasi
latitude
longitude
foto_lokasi
id_status
keterangan_proggress
foto_progress
id_kategori
```

### Tabel `history_laporan`

Menyimpan kondisi sebelum update:

```text
id_history
id_laporan
id_user_pengubah
id_status
keterangan_proggress
history_foto
created_at
updated_at
```

---

## Storage Foto

Foto disimpan menggunakan filesystem public Laravel.

Contoh lokasi:

```text
storage/app/public/laporan
```

Agar dapat diakses dari browser:

```bash
php artisan storage:link
```

Direktori hasil generate seperti `storage/` dan `public/storage/` tidak perlu dimasukkan ke Git.

---

## Menjalankan Aplikasi

Jalankan server Laravel:

```bash
php artisan serve
```

Aplikasi dapat diakses pada:

```text
http://127.0.0.1:8000
```

Untuk development frontend, jalankan Vite pada terminal lain:

```bash
npm run dev
```

---

## Pengujian

Validasi akhir yang telah dilakukan pada project:

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

### Fitur

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
- Pastikan file hasil upload dan environment lokal tetap berada pada konfigurasi yang sesuai.

---

## Status Project

**Tahap: finalisasi.**

Fitur utama yang diminta telah selesai:

```text
Many-to-many kategori ↔ OPD        ✅
Kolaborasi penanganan laporan       ✅
History progress                    ✅
Foto progress                      ✅
Lokasi + koordinat                 ✅
Peta interaktif                     ✅
Admin category management          ✅
Admin read-only laporan             ✅
Testing migration + seeder         ✅
Testing frontend build              ✅
```

Tahap berikutnya berfokus pada final audit, dokumentasi, screenshot/presentasi, dan finalisasi Git.

---

## Referensi

- [Laravel](https://laravel.com/docs)
- [Laravel Socialite](https://laravel.com/docs/socialite)
- [Leaflet](https://leafletjs.com/)
- [OpenStreetMap](https://www.openstreetmap.org/)
