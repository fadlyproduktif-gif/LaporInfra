# LAPORINFRA

**LAPORINFRA** adalah aplikasi web pelaporan kerusakan dan permasalahan infrastruktur yang menghubungkan masyarakat dengan Organisasi Perangkat Daerah (OPD) yang menangani kategori laporan tertentu.

Project ini dikembangkan menggunakan Laravel dan disiapkan agar dapat dijalankan kembali oleh developer lain melalui repository Git, migration, seeder, dan konfigurasi environment.

> **Status:** Fitur utama aplikasi web telah selesai diuji. API masih dalam tahap pengembangan.

---

## Daftar Isi

- [1. Gambaran Umum](#1-gambaran-umum)
- [2. Fitur Utama](#2-fitur-utama)
- [3. Role dan Hak Akses](#3-role-dan-hak-akses)
- [4. Teknologi yang Digunakan](#4-teknologi-yang-digunakan)
- [5. Persyaratan Sistem](#5-persyaratan-sistem)
- [6. Instalasi Project](#6-instalasi-project)
- [7. Konfigurasi Environment](#7-konfigurasi-environment)
- [8. Konfigurasi Google OAuth](#8-konfigurasi-google-oauth)
- [9. Database dan Seeder](#9-database-dan-seeder)
- [10. Storage Foto](#10-storage-foto)
- [11. Frontend dan Chart.js](#11-frontend-dan-chartjs)
- [12. Menjalankan Aplikasi](#12-menjalankan-aplikasi)
- [13. Struktur Project](#13-struktur-project)
- [14. Struktur Database](#14-struktur-database)
- [15. Routing](#15-routing)
- [16. Authentication dan Authorization](#16-authentication-dan-authorization)
- [17. API](#17-api)
- [18. Troubleshooting](#18-troubleshooting)
- [19. Catatan Keamanan](#19-catatan-keamanan)
- [20. Pengembangan Lanjutan](#20-pengembangan-lanjutan)
- [21. Catatan Handover](#21-catatan-handover)

---

# 1. Gambaran Umum

Alur utama aplikasi:

```text
Masyarakat
    │
    │ Membuat laporan
    ▼
Kategori Laporan
    │
    │ menentukan OPD tujuan
    ▼
OPD
    │
    │ memproses laporan
    │ memperbarui status & progress
    ▼
Masyarakat
    │
    │ memantau perkembangan
    ▼
Laporan selesai
```

Administrator berfungsi sebagai pengelola data pendukung sistem dan sebagai pihak yang memantau laporan.

---

# 2. Fitur Utama

## Masyarakat

- Registrasi akun.
- Login menggunakan email dan password.
- Login menggunakan Google.
- Dashboard masyarakat.
- Membuat laporan.
- Mengunggah foto lokasi.
- Melihat daftar laporan milik sendiri.
- Melihat detail laporan.
- Melihat status dan keterangan progress.
- Mengubah email dan password.
- Logout.

## OPD

- Login menggunakan NIP dan password.
- Login menggunakan Google.
- Dashboard OPD.
- Melihat laporan yang ditujukan kepada OPD.
- Melihat detail laporan.
- Memperbarui status dan keterangan progress.
- Melihat grafik statistik laporan.
- Logout.

## Admin

- Login menggunakan Google.
- Dashboard administrator.
- Melihat seluruh laporan.
- Melihat detail laporan.
- Mengelola data OPD.
- Mengelola kategori laporan.
- Mengelola akun pengguna.
- Logout.

> **Catatan:** Admin **tidak mengelola laporan**. Admin hanya dapat melihat daftar dan detail laporan. Perubahan status dan progress laporan dilakukan oleh OPD.

---

# 3. Role dan Hak Akses

| Role | Login | Laporan | Data yang Dikelola |
|---|---|---|---|
| `masyarakat` | Email/password atau Google | Membuat & melihat laporan sendiri | Profil sendiri |
| `opd` | NIP/password atau Google | Melihat & memperbarui laporan OPD | Status dan progress laporan |
| `admin` | Google | Hanya melihat laporan | OPD, kategori, akun |

Nilai role yang disimpan pada database:

```text
admin
opd
masyarakat
```

Istilah pada interface adalah **OPD**, sedangkan beberapa nama internal source code masih menggunakan `devisi`, seperti `Devisi.php`, `id_devisi`, dan controller pada folder `app/Http/Controllers/Devisi/`.

---

# 4. Teknologi yang Digunakan

| Komponen | Teknologi |
|---|---|
| Bahasa | PHP 8.3+ |
| Framework | Laravel 13 |
| Database | MySQL / MariaDB |
| Template | Blade |
| CSS | CSS + Tailwind CSS |
| JavaScript bundler | Vite |
| Grafik | Chart.js |
| OAuth | Laravel Socialite + Google |
| API foundation | Laravel Sanctum |
| PHP dependency manager | Composer |
| JavaScript dependency manager | NPM |

Dependency utama PHP berada pada `composer.json` dan `composer.lock`. Dependency frontend berada pada `package.json` dan `package-lock.json`.

---

# 5. Persyaratan Sistem

Pastikan komputer telah memiliki:

- PHP 8.3 atau lebih baru.
- Composer.
- Node.js dan NPM.
- MySQL atau MariaDB.
- Git.
- Web browser.

Periksa versi:

```bash
php -v
composer -V
node -v
npm -v
git --version
```

---

# 6. Instalasi Project

## 6.1 Clone Repository

```bash
git clone https://github.com/fadlyproduktif-gif/LaporInfra.git
cd LaporInfra
```

## 6.2 Install Dependency

```bash
composer install
npm install
```

`laravel/socialite`, `laravel/sanctum`, dan `chart.js` sudah tercantum sebagai dependency project sehingga tidak perlu di-install manual lagi.

## 6.3 Buat `.env`

Linux/macOS:

```bash
cp .env.example .env
```

Windows PowerShell:

```powershell
Copy-Item .env.example .env
```

## 6.4 Generate Key

```bash
php artisan key:generate
```

## 6.5 Konfigurasi Database

Buat database bernama:

```text
lapinfra
```

Kemudian sesuaikan `.env`:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=lapinfra
DB_USERNAME=root
DB_PASSWORD=
```

## 6.6 Migration dan Seeder

Untuk database baru:

```bash
php artisan migrate --seed
```

Untuk membangun ulang database dari nol:

```bash
php artisan migrate:fresh --seed
```

> `migrate:fresh` menghapus seluruh tabel dan data pada database yang dipilih.

## 6.7 Storage Link

```bash
php artisan storage:link
```

## 6.8 Build Frontend

```bash
npm run build
```

---

# 7. Konfigurasi Environment

Bagian penting pada `.env`:

```env
APP_NAME=Laravel
APP_ENV=local
APP_KEY=
APP_DEBUG=true
APP_URL=http://localhost:8000

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=lapinfra
DB_USERNAME=root
DB_PASSWORD=

GOOGLE_CLIENT_ID=
GOOGLE_CLIENT_SECRET=
GOOGLE_REDIRECT_URI=http://127.0.0.1:8000/auth/google/callback
```

`.env` tidak boleh di-commit ke repository.

---

# 8. Konfigurasi Google OAuth

LAPORINFRA menggunakan **Laravel Socialite** untuk Google OAuth.

Referensi resmi:
- [Laravel Socialite](https://laravel.com/docs/13.x/socialite)
- [Google OAuth 2.0 for Web Server Applications](https://developers.google.com/identity/protocols/oauth2/web-server)

## 8.1 Buat Google Cloud Project

Buka [Google Cloud Console](https://console.cloud.google.com/) lalu buat project baru atau gunakan project yang sudah ada.

## 8.2 Buat OAuth Client

Pada Google Cloud Console, buka bagian OAuth / Google Auth Platform dan Credentials, lalu buat **OAuth Client ID** dengan jenis:

```text
Web application
```

## 8.3 Authorized Redirect URIs

Tambahkan seluruh callback berikut:

```text
http://127.0.0.1:8000/auth/google/callback
http://127.0.0.1:8000/auth/google/masyarakat/callback
http://127.0.0.1:8000/auth/google/opd/callback
```

Untuk environment lokal, gunakan host dan port yang konsisten.

## 8.4 Isi `.env`

```env
GOOGLE_CLIENT_ID=CLIENT_ID_ANDA
GOOGLE_CLIENT_SECRET=CLIENT_SECRET_ANDA
GOOGLE_REDIRECT_URI=http://127.0.0.1:8000/auth/google/callback
```

Lalu:

```bash
php artisan optimize:clear
```

### Alur Login

```text
Masyarakat → /auth/google/masyarakat → Google → /auth/google/masyarakat/callback
OPD        → /auth/google/opd        → Google → /auth/google/opd/callback
Admin      → /auth/google            → Google → /auth/google/callback
```

### Aturan akun

**Masyarakat:** akun dapat dibuat pada login Google pertama sesuai implementasi controller.

**OPD:** akun harus sudah terdaftar oleh Admin terlebih dahulu.

**Admin:** hanya menggunakan Google Login. Tidak tersedia login Admin menggunakan email/password. Akun Admin dibuat melalui `AdminSeeder.php`; periksa dan sesuaikan email Admin sebelum mendistribusikan project.

> Jangan pernah memasukkan Client Secret ke GitHub atau README.

---

# 9. Database dan Seeder

Migration digunakan agar database dapat dibangun ulang pada komputer lain.

Migration utama:

```text
database/migrations/
├── 0000_12_31_235900_create_devisi_table.php
├── 0001_01_01_000000_create_users_table.php
├── 0001_01_01_000001_create_cache_table.php
├── 0001_01_01_000002_create_jobs_table.php
├── 2026_08_17_084044_create_kategori_table.php
├── 2026_08_17_142324_create_status_laporan_table.php
├── 2026_08_18_141741_create_laporan_table.php
└── 2026_08_31_012044_create_personal_access_tokens_table.php
```

Seeder:

```text
database/seeders/
├── AdminSeeder.php
├── DatabaseSeeder.php
├── DevisiSeeder.php
├── KategoriSeeder.php
└── StatusLaporanSeeder.php
```

`migrate --seed` mengisi data awal OPD, kategori, status laporan, dan Admin.

---

# 10. Storage Foto

Foto laporan disimpan pada filesystem public Laravel, di lokasi seperti:

```text
storage/app/public/laporan
```

Agar dapat diakses melalui web:

```bash
php artisan storage:link
```

Link yang digunakan:

```text
public/storage
```

Folder berikut tidak perlu di-commit:

```text
storage/
public/storage/
```

---

# 11. Frontend dan Chart.js

Project menggunakan Vite untuk build asset frontend dan Chart.js untuk grafik dashboard OPD.

Entry JavaScript utama terkait dashboard OPD:

```text
resources/js/devisi-dashboard.js
```

Dependency Chart.js berada pada `package.json`.

Build production:

```bash
npm run build
```

Mode development:

```bash
npm run dev
```

---

# 12. Menjalankan Aplikasi

Setelah instalasi:

```bash
php artisan serve
```

Buka:

```text
http://127.0.0.1:8000
```

Pada mode development, Vite dapat dijalankan pada terminal terpisah:

```bash
npm run dev
```

---

# 13. Struktur Project

Struktur penting:

```text
LaporInfra/
├── app/
│   ├── Http/Controllers/
│   │   ├── Admin/
│   │   ├── Auth/
│   │   ├── Devisi/
│   │   └── Masyarakat/
│   ├── Http/Middleware/RoleMiddleware.php
│   └── Models/
├── bootstrap/
├── config/
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
├── tests/
├── artisan
├── composer.json
├── composer.lock
├── package.json
├── package-lock.json
└── vite.config.js
```

Folder generated/ignored seperti `node_modules/`, `vendor/`, `storage/`, `public/build/`, dan `public/storage/` tidak perlu dimasukkan ke Git.

---

# 14. Struktur Database

Relasi utama:

```text
                     devisi
                    /      \
                   /        \
                  ↓          ↓
               users      kategori
                              │
                              ↓
                           laporan
                              │
                              ↓
                      status_laporan
```

## `devisi`

| Kolom | Keterangan |
|---|---|
| `id_devisi` | Primary key |
| `nama_devisi` | Nama OPD |
| `created_at` | Timestamp |
| `updated_at` | Timestamp |

## `users`

| Kolom | Keterangan |
|---|---|
| `id_user` | Primary key |
| `nip` | NIP, nullable, unique |
| `nama_user` | Nama pengguna |
| `email` | Email, unique |
| `password` | Password, nullable |
| `google_id` | ID Google, nullable, unique |
| `role` | `admin`, `opd`, `masyarakat` |
| `id_devisi` | Foreign key ke `devisi` |

## `kategori`

| Kolom | Keterangan |
|---|---|
| `id_kategori` | Primary key |
| `nama_kategori` | Nama kategori |
| `id_devisi` | Foreign key ke `devisi` |

## `status_laporan`

| Kolom | Keterangan |
|---|---|
| `id_status` | Primary key |
| `nama_status` | Nama status |

## `laporan`

| Kolom | Keterangan |
|---|---|
| `id_laporan` | Primary key |
| `id_user` | Foreign key ke `users` |
| `nama_laporan` | Nama/judul laporan |
| `deskripsi` | Deskripsi masalah |
| `lokasi` | Lokasi |
| `foto_lokasi` | Path/nama file foto |
| `id_status` | Foreign key ke `status_laporan`, nullable |
| `keterangan_proggress` | Keterangan progress |
| `id_kategori` | Foreign key ke `kategori` |

### Foreign key utama

```text
users.id_devisi       → devisi.id_devisi       ON DELETE SET NULL
kategori.id_devisi    → devisi.id_devisi       ON DELETE RESTRICT
laporan.id_user       → users.id_user           ON DELETE RESTRICT
laporan.id_kategori   → kategori.id_kategori    ON DELETE RESTRICT
laporan.id_status     → status_laporan.id_status ON DELETE SET NULL
```

Project juga memiliki migration `personal_access_tokens` sebagai fondasi Laravel Sanctum.

---

# 15. Routing

## Public

| Method | URI | Fungsi |
|---|---|---|
| GET | `/` | Landing page |
| GET | `/login` | Pemilihan jenis login |

## Masyarakat

| Method | URI | Fungsi |
|---|---|---|
| GET | `/auth/login-masyarakat` | Halaman login |
| POST | `/auth/register-masyarakat` | Proses login masyarakat |
| GET | `/auth/register-masyarakat` | Halaman registrasi |
| POST | `/register-masyarakat` | Proses registrasi |
| GET | `/auth/google/masyarakat` | Redirect Google |
| GET | `/auth/google/masyarakat/callback` | Callback Google |
| GET | `/masyarakat/dashboard` | Dashboard |
| GET | `/masyarakat/form-laporan` | Form laporan |
| POST | `/masyarakat/form-laporan` | Simpan laporan |
| GET | `/masyarakat/laporan-saya` | Daftar laporan |
| GET | `/masyarakat/detail-laporan/{id_laporan}` | Detail laporan |
| GET | `/masyarakat/profil-saya` | Profil |
| PUT | `/masyarakat/profil-saya/update-email` | Ubah email |
| PUT | `/masyarakat/profil-saya/update-password` | Ubah password |
| POST | `/logout-masyarakat` | Logout |

## OPD

| Method | URI | Fungsi |
|---|---|---|
| GET | `/auth/login-opd` | Halaman login OPD |
| POST | `/login-opd` | Proses login OPD |
| GET | `/auth/google/opd` | Redirect Google |
| GET | `/auth/google/opd/callback` | Callback Google |
| GET | `/opd/dashboard` | Dashboard |
| GET | `/opd/laporan` | Daftar laporan |
| GET | `/opd/detail-laporan/{id_laporan}` | Detail laporan |
| PUT | `/opd/laporan/update` | Update status/progress |
| POST | `/logout-devisi` | Logout |

## Admin

| Method | URI | Fungsi |
|---|---|---|
| GET | `/auth/login-admin` | Halaman login Admin |
| GET | `/auth/google` | Redirect Google |
| GET | `/auth/google/callback` | Callback Google |
| GET | `/admin/dashboard` | Dashboard |
| GET | `/admin/laporan` | Melihat seluruh laporan |
| GET | `/admin/laporan/{id_laporan}` | Detail laporan |
| GET | `/admin/kategori` | Data kategori |
| POST | `/admin/kategori/store` | Tambah kategori |
| PUT | `/admin/kategori/update/{id}` | Ubah kategori |
| DELETE | `/admin/kategori/delete/{id}` | Hapus kategori |
| GET | `/admin/devisi` | Data OPD |
| POST | `/admin/devisi/store` | Tambah OPD |
| PUT | `/admin/devisi/update/{id_devisi}` | Ubah OPD |
| DELETE | `/admin/devisi/delete/{id_devisi}` | Hapus OPD |
| GET | `/admin/akun` | Data akun |
| POST | `/admin/akun/store` | Tambah akun |
| PUT | `/admin/akun/update/{id_user}` | Ubah akun |
| DELETE | `/admin/akun/delete/{id_user}` | Hapus akun |
| POST | `/logout-admin` | Logout |

> Admin hanya memiliki route `GET` untuk laporan. Tidak ada route Admin untuk mengubah status atau isi laporan.

---

# 16. Authentication dan Authorization

Jenis login:

```text
Masyarakat
├── Email + Password
└── Google OAuth

OPD
├── NIP + Password
└── Google OAuth

Admin
└── Google OAuth
```

Google OAuth menggunakan Laravel Socialite.

Controller OAuth:

```text
app/Http/Controllers/Auth/
├── AdminGoogleController.php
├── MasyarakatGoogleController.php
└── OpdGoogleController.php
```

Akses role dibatasi dengan middleware `auth` dan `role`, contoh:

```php
Route::middleware(['auth', 'role:masyarakat'])->group(...);
```

---

# 17. API

Endpoint API yang saat ini tersedia:

| Method | Endpoint | Keterangan |
|---|---|---|
| GET | `/api/user` | Mengembalikan `Auth::user()` |
| GET | `/api/laporan` | Mengembalikan seluruh data laporan |

Implementasi saat ini masih sederhana:

```php
Route::get('/user', function (Request $request) {
    return Auth::User();
});

Route::get('/laporan', function (Request $request) {
    return Laporan::all();
});
```

## Status API

API **belum selesai dikembangkan** dan bukan mekanisme utama aplikasi web.

Sanctum sudah dipasang sebagai fondasi, tetapi endpoint saat ini belum seluruhnya menggunakan:

```text
auth:sanctum
```

Referensi: [Laravel Sanctum](https://laravel.com/docs/13.x/sanctum)

Pengembangan berikutnya dapat mencakup API login/token, `auth:sanctum`, CRUD laporan, validation, authorization berbasis role, API Resource, dan dokumentasi endpoint.

---

# 18. Troubleshooting

## `Duplicate column name 'id_laporan'`

Pastikan migration `create_laporan_table` menggunakan:

```php
$table->id('id_laporan');
$table->foreignId('id_status');
```

Bukan foreign key kedua dengan nama `id_laporan`.

## `redirect_uri_mismatch`

Periksa tiga redirect URI Google dan nilai `.env`, lalu jalankan:

```bash
php artisan optimize:clear
```

## Google Login gagal di komputer baru

Periksa `GOOGLE_CLIENT_ID`, `GOOGLE_CLIENT_SECRET`, redirect URI, host/port aplikasi, dan pembatasan user/tester pada konfigurasi OAuth.

## `chart.js/auto` tidak ditemukan

```bash
npm install
npm run build
```

## `public/storage` sudah ada

Pesan bahwa link sudah ada bukan error aplikasi. Tidak perlu membuat link kedua.

## `The "intl" PHP extension is required`

Error pada command diagnostik seperti `php artisan db:table` dapat berkaitan dengan ekstensi PHP yang dibutuhkan command tersebut dan tidak otomatis berarti database aplikasi rusak.

---

# 19. Catatan Keamanan

- Jangan commit `.env`.
- Jangan commit Google Client Secret.
- Jangan menaruh credential Google pada README.
- Jangan mengunggah credential ke repository publik.
- Sesuaikan email Admin pada `AdminSeeder.php` sebelum mendistribusikan project.
- Jangan menggunakan data laporan pengguna asli sebagai data development yang dibagikan.
- Gunakan `migrate:fresh` hanya pada database yang memang boleh dihapus.

---

# 20. Pengembangan Lanjutan

Beberapa bagian yang dapat dikembangkan:

### API

```text
API Authentication
API CRUD
Authorization
Validation
API Resource
API Documentation
```

### Sistem Laporan

- Riwayat perubahan status.
- Notifikasi perubahan status.
- Penugasan laporan ke petugas internal OPD.
- Filter dan pencarian yang lebih lengkap.
- Export laporan.
- Dashboard statistik yang lebih lengkap.

### Authentication

- Email verification.
- Password reset.
- Manajemen OAuth yang lebih fleksibel.
- Credential terpisah untuk development dan production.

### Deployment

- HTTPS.
- Server production.
- Database production.
- Cloud storage.
- Queue/background processing.
- Konfigurasi environment production.

---

# 21. Catatan Handover

Fitur utama yang telah diuji:

- Clone repository.
- Instalasi dependency Composer dan NPM.
- Konfigurasi `.env`.
- Migration dan seeder database.
- Login masyarakat.
- Login OPD.
- Google Login.
- Login Admin melalui Google.
- Registrasi masyarakat.
- Pembuatan laporan.
- Upload foto laporan.
- Melihat laporan masyarakat.
- Pemrosesan laporan oleh OPD.
- Update status dan progress.
- Dashboard OPD dan grafik Chart.js.
- Pengelolaan OPD oleh Admin.
- Pengelolaan kategori oleh Admin.
- Pengelolaan akun oleh Admin.
- Monitoring seluruh laporan oleh Admin.

### Batasan versi saat ini

Admin hanya dapat melihat laporan dan detailnya.

API masih dalam tahap pengembangan.

Beberapa nama internal source code masih menggunakan istilah `devisi`, walaupun istilah yang digunakan pada interface adalah **OPD**.

---

# Referensi

- [Laravel 13 Documentation](https://laravel.com/docs/13.x)
- [Laravel Installation](https://laravel.com/docs/13.x/installation)
- [Laravel Migrations](https://laravel.com/docs/13.x/migrations)
- [Laravel Filesystem](https://laravel.com/docs/13.x/filesystem)
- [Laravel Socialite](https://laravel.com/docs/13.x/socialite)
- [Laravel Sanctum](https://laravel.com/docs/13.x/sanctum)
- [Google OAuth 2.0 for Web Server Applications](https://developers.google.com/identity/protocols/oauth2/web-server)

---

## License

Project ini dikembangkan sebagai bagian dari kegiatan magang. Ketentuan penggunaan, distribusi, dan pengembangan selanjutnya dapat ditentukan oleh pihak pengelola project.
