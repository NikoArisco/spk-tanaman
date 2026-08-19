# 🌿 Sistem Pendukung Keputusan (SPK) Rekomendasi Tanaman – Metode SAW

![Laravel Version](https://img.shields.io/badge/Laravel-12.x-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)
![PHP Version](https://img.shields.io/badge/PHP-8.2%2B-777BB4?style=for-the-badge&logo=php&logoColor=white)
![AdminLTE](https://img.shields.io/badge/AdminLTE-3.x-3C8DBC?style=for-the-badge&logo=adminlte&logoColor=white)
![Tailwind CSS](https://img.shields.io/badge/Tailwind_CSS-4.x-06B6D4?style=for-the-badge&logo=tailwindcss&logoColor=white)
![Vite](https://img.shields.io/badge/Vite-6.x-646CFF?style=for-the-badge&logo=vite&logoColor=white)
![License](https://img.shields.io/badge/License-MIT-green.svg?style=for-the-badge)

Aplikasi Web **Sistem Pendukung Keputusan (SPK)** berbasis **Laravel 12** yang dirancang untuk merekomendasikan jenis tanaman pertanian paling optimal berdasarkan parameter kondisi lingkungan setempat. Menggunakan algoritma **Simple Additive Weighting (SAW)** yang dipadukan dengan **Hybrid Categorical & Distance-Based Fuzzy Normalization**.

---

## 📐 Deskripsi Multi-Perspektif

### 💻 1. Fullstack Developer Perspective
- **Backend Architecture:** Dibangun dengan **PHP 8.2+** dan **Laravel 12 Framework**. Menggunakan arsitektur MVC, Eloquent ORM dengan relasi *Many-to-Many* (via Pivot Table), custom Middleware (`CekPeran`) untuk Multi-Role Authentication (**Admin** & **Petani**).
- **Frontend & UI/UX:** Memadukan dashboard **AdminLTE 3** untuk area administrasi dan **Tailwind CSS 4** + **Vite** untuk antarmuka publik/petani yang responsif.
- **Session & Analytics Logging:** Setiap input parameter lingkungan petani disimpan secara permanen ke tabel `data_lingkungan` dan hasil perankingan dicatat ke tabel `rekomendasi` untuk audit riwayat serta analisis tren.

### 🤖 2. AI & Decision Support System (SPK) Engineer Perspective
- **Algoritma Utama:** **Simple Additive Weighting (SAW)** — metode penjumlahan terbobot pada kriteria yang telah dinormalisasi.
- **Hybrid Normalization Engine:**
  - **Kriteria Kategorikal (*Jenis Tanah*, *Ketersediaan Air*):** Evaluasi kecocokan persis (*Exact Binary Matching*) nilai preferensi tanaman vs parameter input.
  - **Kriteria Kontinu/Numerik Berbasis Rentang (*Suhu*, *Curah Hujan*, *Kelembaban*):** Menggunakan fungsi keanggotaan linier fuzzy berbasis jarak (*distance-based linear fuzzy normalization*) dari titik ideal rentang optimal \([min, max]\).
- **Penilaian & Perankingan:** Menghasilkan skor preferensi akhir \(V_i \in [0, 1]\) secara *real-time* yang diurutkan secara deskresensial (*descending*) untuk menentukan alternatif tanaman terbaik.

### 📊 3. Data Analyst Perspective
- **Struktur Kriteria & Bobot Penilaian:**
  1. \(C_1\) **Jenis Tanah** — Bobot \(0.20\) *(Benefit, Kategorikal)*
  2. \(C_2\) **Suhu (°C)** — Bobot \(0.25\) *(Benefit, Rentang Numerik)*
  3. \(C_3\) **Curah Hujan (mm)** — Bobot \(0.20\) *(Benefit, Rentang Numerik)*
  4. \(C_4\) **Ketersediaan Air** — Bobot \(0.20\) *(Benefit, Kategorikal)*
  5. \(C_5\) **Kelembaban (%)** — Bobot \(0.15\) *(Benefit, Rentang Numerik)*
  $$\sum_{j=1}^{5} w_j = 0.20 + 0.25 + 0.20 + 0.20 + 0.15 = 1.00$$
- **Analitik & Dashboard:** Menyajikan grafik distribusi frekuensi hasil rekomendasi tanaman teratas secara visual (*Chart.js*) untuk membantu pemetaan komoditas dominan berdasarkan variabel agroklimat yang diinput oleh petani.

---

## ✨ Fitur Utama

- 🔓 **Authentication & Authorization:** System Login & Register dengan pemisahan peran (**Admin** & **Petani**).
- 📈 **Admin Dashboard Analytics:** Visualisasi data rekomendasi tanaman teratas, statistik total pengguna, total kriteria, dan total alternatif tanaman.
- ⚙️ **CRUD Manajemen Kriteria:** Pengaturan nama kriteria, bobot preferensi (\(w_j\)), dan tipe kriteria (*benefit*/*cost*).
- 🌾 **CRUD Manajemen Tanaman & Threshold:** Pengelolaan alternatif tanaman beserta ambang batas rentang optimal untuk masing-masing kriteria.
- 👥 **User Management:** Pengelolaan akun pengguna dan peran sistem.
- 🧮 **Engine Perhitungan SAW Real-time:** Form input kondisi lingkungan interaktif bagi petani, lengkap dengan matriks keputusan, matriks ternormalisasi, dan skor akhir perankingan.
- 📜 **Riwayat Perhitungan:** Pelacakan dan inspeksi ulang hasil rekomendasi masa lalu bagi petani.

---

## 🛠️ Tech Stack & Dependensi

| Layer | Teknologi / Package |
| :--- | :--- |
| **Language** | PHP ^8.2 |
| **Framework** | Laravel ^12.0 |
| **Frontend UI** | AdminLTE ^3.15, Tailwind CSS ^4.0 |
| **Build Tool & Bundler** | Vite ^6.2, Laravel Vite Plugin ^1.2 |
| **Database** | MySQL / MariaDB / SQLite |
| **Authentication** | Laravel Sanctum & Session Auth |
| **Testing** | Pest PHP ^3.8 |

---

## 🧮 Metodologi SPK & Formula Matematika

### 1. Normalisasi Matriks Keputusan (\(r_{ij}\))

- **Untuk Kriteria Kategorikal** (*Jenis Tanah*, *Ketersediaan Air*):
  $$r_{ij} = \begin{cases} 1, & \text{jika } \text{input} = \text{preferensi tanaman} \\ 0, & \text{jika } \text{input} \neq \text{preferensi tanaman} \end{cases}$$

- **Untuk Kriteria Rentang Numerik** (*Suhu*, *Curah Hujan*, *Kelembaban*) dengan rentang \([min, max]\):
  $$X_{ideal} = \frac{max + min}{2}, \quad H = \frac{max - min}{2}$$
  $$Jarak = |X_{input} - X_{ideal}|$$
  $$r_{ij} = \begin{cases} 1 - \left(\frac{Jarak}{H}\right), & \text{jika } Jarak \le H \\ 0, & \text{jika } Jarak > H \end{cases}$$

### 2. Nilai Preferensi Akhir (\(V_i\))

Total skor untuk setiap alternatif tanaman \(i\):
$$V_i = \sum_{j=1}^{n} (r_{ij} \times w_j)$$

Alternatif dengan nilai \(V_i\) tertinggi merupakan tanaman yang **paling direkomendasikan**.

---

## 🗄️ Skema Database & Relasi

- `users`: Data pengguna (id, nama, username, password, peran: 'Admin'/'Petani').
- `kriteria`: Data kriteria penilaian (id, nama_kriteria, bobot, tipe).
- `tanaman`: Data alternatif tanaman (id, nama_tanaman).
- `kriteria_tanaman`: Pivot table antara tanaman dan kriteria (id_tanaman, id_kriteria, nilai).
- `data_lingkungan`: Log input kondisi fisik lingkungan oleh petani (id, id_user, jenis_tanah, suhu, curah_hujan, ketersediaan_air, kelembaban).
- `rekomendasi`: Log skor rekomendasi akhir hasil perhitungan SAW (id, id_data, id_tanaman, skor).

---

## 🚀 Panduan Instalasi & Penggunaan

### 1. Prasyarat System
- PHP >= 8.2
- Composer >= 2.x
- Node.js >= 18.x & NPM
- Database MySQL / MariaDB / SQLite

### 2. Langkah Instalasi

```bash
# 1. Clone Repositori
git clone https://github.com/RizalRio/spk-tanaman.git
cd spk-tanaman

# 2. Install Dependensi PHP & Node.js
composer install
npm install

# 3. Salin File Konfigurasi Environment
cp .env.example .env

# 4. Generate Application Key
php artisan key:generate

# 5. Konfigurasi Database pada .env
# Sesuaikan DB_DATABASE, DB_USERNAME, DB_PASSWORD

# 6. Jalankan Migrasi & Seeder Database
php artisan migrate --seed

# 7. Build Asset Frontend atau Jalankan Dev Server
npm run build
```

### 3. Menjalankan Aplikasi (Development Mode)

Gunakan script bawaan composer untuk menjalankan server Laravel, listener queue, dan Vite secara simultan:

```bash
composer run dev
```

Atau secara manual pada terminal terpisah:

```bash
# Terminal 1: Laravel Backend
php artisan serve

# Terminal 2: Vite Dev Server
npm run dev
```

Akses aplikasi di browser pada: `http://127.0.0.1:8000`

### 🔑 4. Akun Bawaan (Default Credentials)

Setelah menjalankan `php artisan migrate --seed`, Anda dapat menggunakan akun pengguna bawaan berikut untuk menguji sistem:

| Peran (Role) | Username | Password | Hak Akses & Fitur |
| :--- | :--- | :--- | :--- |
| **Admin** | `admin` | `password123` | Dashboard Statistik, CRUD Kriteria, CRUD Tanaman, & CRUD Users |
| **Petani** | `petani` | `password123` | Form Input Parameter Lingkungan, Hitung SAW, & Riwayat Rekomendasi |

---

## 🛣️ Struktur Rute & Hak Akses

| Method | URI | Controller Action | Middleware / Role | Function |
| :--- | :--- | :--- | :--- | :--- |
| `GET` | `/` | `LandingController@index` | Public | Halaman Utama / Landing Page |
| `GET/POST` | `/login` | `AuthController@...` | Guest | Login User |
| `GET/POST` | `/register` | `AuthController@...` | Guest | Registrasi Akun Petani |
| `GET` | `/admin/dashboard` | `Admin\DashboardController@index` | `auth, admin:Admin` | Dashboard Admin & Analisis Grafik |
| `RESOURCE`| `/admin/kriteria` | `Admin\KriteriaController` | `auth, admin:Admin` | CRUD Data Kriteria |
| `RESOURCE`| `/admin/tanaman` | `Admin\TanamanController` | `auth, admin:Admin` | CRUD Data Tanaman & Threshold |
| `RESOURCE`| `/admin/users` | `Admin\UserController` | `auth, admin:Admin` | CRUD User & Hak Akses |
| `GET/POST` | `/perhitungan` | `PerhitunganController@...` | `auth` | Form Input & Proses Hitung SAW |
| `GET` | `/riwayat` | `RiwayatController@index` | `auth` | Daftar Riwayat Rekomendasi |
| `GET` | `/riwayat/{id}` | `RiwayatController@show` | `auth` | Detail Inspeksi Perhitungan Masa Lalu |

---

## 💡 Pengembang

Dikembangkan oleh **RizalRio** dengan fokus pada penerapan metode pengambil keputusan berbasis SAW, arsitektur web modern Laravel 12, dan analitik agrikultur.

