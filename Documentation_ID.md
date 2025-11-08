# Dokumentasi Proyek AI-Powered Time Management

## 1. Gambaran Umum Proyek

AI-Powered Time Management adalah sistem manajemen waktu berbasis web yang dirancang untuk membantu pengguna dalam melacak waktu kerja, memprediksi durasi tugas, dan meningkatkan produktivitas tim melalui teknologi kecerdasan buatan (AI). Proyek ini dibangun menggunakan framework Laravel 12 dan berjalan di atas bahasa pemrograman PHP.

Nama Proyek: AI Time Manager
Tanggal Dokumentasi: 9 November 2025
Basis Kode: Laravel 12
Bahasa: PHP 8.2
Lisensi: MIT

## 2. Arsitektur dan Teknologi

### 2.1 Teknologi Utama
- **Backend**: Laravel 12 Framework
- **Bahasa Pemrograman**: PHP 8.2
- **Database**: MySQL (dengan migrasi siap digunakan)
- **Frontend**: Blade Templates, Tailwind CSS, Alpine.js
- **Build Tool**: Vite
- **Testing**: PestPHP, PHPUnit
- **CSS Framework**: Tailwind CSS dengan plugin forms
- **Authentication**: Laravel Breeze (Login/Register)

### 2.2 Struktur Proyek
```
ai-powered-time-management/
├── app/                    # Kode aplikasi utama
│   ├── Http/              # Controller, Requests, Middleware
│   ├── Models/            # Model Eloquent
│   ├── Providers/         # Service Providers
│   └── View/              # Komponen Blade
├── bootstrap/             # File bootstrap framework
├── config/                # File konfigurasi
├── database/              # Migrasi, seeder, factory
├── public/                # Aset publik
├── resources/             # View, CSS, JS
├── routes/                # File rute
├── storage/               # File disimpan
├── tests/                 # File test
├── artisan                # Command line tool
├── composer.json          # Dependency PHP
├── package.json           # Dependency Node
└── ...
```

### 2.3 Fitur Utama (Terencana/Implementasi)
- Pelacakan waktu real-time
- Prediksi durasi tugas menggunakan AI
- Dashboard manajemen proyek
- Sistem autentikasi pengguna
- Manajemen tugas dan proyek
- Laporan produktivitas visual

## 3. Struktur Database dan Model

### 3.1 Tabel Utama
Sistem ini menggunakan beberapa tabel utama untuk menyimpan dan mengelola data:

#### 3.1.1 users
- id: Primary key
- name: Nama pengguna
- email: Email pengguna (unik)
- email_verified_at: Waktu verifikasi email
- password: Password terenkripsi
- created_at, updated_at: Timestamp

#### 3.1.2 projects
- id: Primary key
- owner_id: Foreign key ke users (pemilik proyek)
- title: Judul proyek
- description: Deskripsi proyek
- status: Status proyek
- created_at, updated_at: Timestamp

#### 3.1.3 tasks
- id: Primary key
- project_id: Foreign key ke projects
- title: Judul tugas
- description: Deskripsi tugas
- status: Status tugas (todo, in progress, completed)
- priority: Prioritas tugas
- due_date: Tanggal jatuh tempo
- estimated_hours: Estimasi jam kerja
- ai_predicted_hours: Jam prediksi AI (fitur utama)
- created_at, updated_at: Timestamp

#### 3.1.4 time_entries
- id: Primary key
- user_id: Foreign key ke users
- task_id: Foreign key ke tasks
- start_time: Waktu mulai
- end_time: Waktu selesai
- duration_minutes: Durasi dalam menit
- notes: Catatan tambahan
- created_at, updated_at: Timestamp

#### 3.1.5 project_user (pivot table)
- id: Primary key
- project_id: Foreign key ke projects
- user_id: Foreign key ke users

#### 3.1.6 task_user (pivot table)
- id: Primary key
- task_id: Foreign key ke tasks
- user_id: Foreign key ke users

#### 3.1.7 sessions (untuk manajemen sesi)
- id: Session ID
- user_id: Foreign key ke users
- ip_address: Alamat IP
- user_agent: Informasi browser
- payload: Data sesi
- last_activity: Aktivitas terakhir

#### 3.1.8 cache (tabel cache)
- key: Kunci cache
- value: Nilai cache
- expiration: Tanggal kadaluarsa

### 3.2 Model PHP
- **User.php**: Model pengguna dengan otentikasi Laravel
- Model lainnya akan dibuat sesuai kebutuhan (Project, Task, TimeEntry, dll)

## 4. Rute dan Controller

### 4.1 Rute Utama
Sistem ini menggunakan struktur rute yang terorganisir:

#### 4.1.1 Web Routes (web.php)
- `/` - Halaman beranda (welcome page)
- `/dashboard` - Dashboard pengguna (memerlukan autentikasi)
- `/profile` - Pengaturan profil (memerlukan autentikasi)
- `/projects` - Daftar proyek (memerlukan autentikasi)

#### 4.1.2 Authentication Routes (auth.php)
- `/register` - Halaman pendaftaran
- `/login` - Halaman login
- `/forgot-password` - Reset password
- `/reset-password` - Set password baru
- `/verify-email` - Verifikasi email
- `/confirm-password` - Konfirmasi password
- `/logout` - Keluar aplikasi

### 4.2 Controller

#### 4.2.1 ProfileController
- `edit()`: Menampilkan form edit profil
- `update()`: Memperbarui informasi profil
- `destroy()`: Menghapus akun pengguna

#### 4.2.2 Auth Controllers
- `AuthenticatedSessionController`: Login/logout
- `RegisteredUserController`: Registrasi pengguna
- `VerifyEmailController`: Verifikasi email
- `PasswordController`: Manajemen password
- Dan lainnya (NewPasswordController, PasswordResetLinkController, dll)

### 4.3 Rute Proyek
Rute `/projects` saat ini menggunakan data dummy untuk menampilkan beberapa proyek contoh, termasuk:
1. "AI: Analisis Sentimen Pasar" (sedang berlangsung, 60%)
2. "Web Manajemen Waktu (Internal)" (menunggu, 10%)
3. "Desain Landing Page Klien" (selesai, 100%)

## 5. Komponen Frontend dan UI

### 5.1 Tampilan Utama
- **welcome.blade.php**: Halaman beranda dengan elemen AI yang menarik
- **dashboard.blade.php**: Dashboard pengguna (dari Laravel Breeze)
- **profile/edit.blade.php**: Form pengeditan profil (dari Laravel Breeze)
- **projects/index.blade.php**: Halaman daftar proyek dengan animasi halus

### 5.2 Teknologi Frontend
- **Tailwind CSS**: Framework CSS untuk desain responsif dan modern
- **Alpine.js**: Framework JavaScript untuk interaktivitas
- **Vite**: Build tool modern untuk CSS/JS
- **Blade Templates**: Template engine Laravel

### 5.3 Desain dan Pengalaman Pengguna
- Desain responsif yang bekerja di berbagai ukuran layar
- Animasi transisi yang halus menggunakan CSS keyframes
- Tema terang dan gelap (dark mode support)
- Tampilan yang menekankan fitur AI dalam manajemen waktu
- Kartu proyek interaktif dengan indikator status dan progres

### 5.4 Elemen UI Khusus AI
- Header dengan nama "AI Time Manager"
- Bagian fitur yang menonjolkan "Prediksi Cerdas AI"
- Deskripsi tentang manfaat AI dalam estimasi waktu dan pelacakan
- Animasi yang meningkatkan pengalaman pengguna

## 6. Fungsionalitas AI dan Fitur Terencana

### 6.1 Fungsi AI yang Terintegrasi
- Kolom `ai_predicted_hours` di tabel tasks menunjukkan bahwa sistem direncanakan memiliki fungsionalitas prediksi AI
- Fitur ini akan menganalisis data historis untuk memprediksi durasi tugas di masa depan
- Penggunaan AI untuk memperkirakan efisiensi waktu dan produktivitas

### 6.2 Fungsi AI Terencana
- **Prediksi Durasi Tugas**: Berdasarkan data historis pengguna dan tipe tugas
- **Analisis Produktivitas**: Pemantauan pola kerja dan saran optimasi
- **Pemberitahuan Cerdas**: Rekomendasi waktu untuk tugas tertentu
- **Klasifikasi Tugas**: Otomatisasi jenis tugas berdasarkan deskripsi
- **Analisis Waktu Real-time**: Pemantauan dan prediksi waktu secara langsung

### 6.3 Algoritma AI yang Mungkin Digunakan
- Regresi linier untuk prediksi durasi tugas
- Analisis tren waktu untuk saran optimalisasi
- Pembelajaran mesin untuk pengelompokan tugas dan rekomendasi

### 6.4 Implementasi Fungsionalitas AI
Saat ini, kolom `ai_predicted_hours` di tabel tasks disediakan untuk menyimpan hasil prediksi AI, tetapi logika prediksi AI belum diimplementasikan. Ini menunjukkan bahwa sistem dirancang untuk menambahkan fungsionalitas AI di masa mendatang.

## 7. Konfigurasi dan Setup

### 7.1 Persyaratan Sistem
- PHP 8.2 atau lebih tinggi
- Composer (untuk manajemen dependensi PHP)
- Node.js dan npm (untuk asset build)
- Database MySQL (atau SQLite untuk development)

### 7.2 Setup Awal
Perintah setup terdapat di file composer.json:
```bash
composer run setup
```
Ini akan:
- Menginstal dependensi PHP
- Membuat file .env jika belum ada
- Generate app key
- Menjalankan migrasi database
- Menginstal dependensi Node
- Membangun aset frontend

### 7.3 Perintah Pengembangan
- `composer run dev`: Menjalankan server pengembangan dengan server PHP, queue, log, dan Vite watcher
- `composer run test`: Menjalankan tes
- `npm run dev`: Menjalankan Vite development server
- `npm run build`: Membangun aset untuk produksi

## 8. Arsitektur Aplikasi

### 8.1 Pattern yang Digunakan
- MVC (Model-View-Controller)
- Repository Pattern (akan diterapkan)
- Service Layer Pattern (akan diterapkan untuk logika AI)

### 8.2 Security Features
- Otentikasi dan otorisasi Laravel
- CSRF Protection
- Validasi input
- Enkripsi password
- Rate limiting pada login

### 8.3 Scalability Features
- Queue System (laravel/queue dalam rencana)
- Cache (Laravel cache system)
- Database indexing
- Eloquent relationship optimization

## 9. Pengembangan dan Pengujian

### 9.1 Testing Framework
- PestPHP sebagai testing framework utama
- PHPUnit sebagai alternatif
- Unit test, feature test, dan database testing

### 9.2 Development Tools
- Laravel Pint untuk formatting kode
- Laravel Sail untuk container development
- Laravel Breeze untuk scaffolding autentikasi

## 10. Kesimpulan

Proyek AI-Powered Time Management adalah sistem manajemen waktu yang dirancang dengan baik dengan potensi besar untuk penerapan AI. Saat ini sistem memiliki fondasi yang kuat dengan:
- Arsitektur Laravel yang solid
- Sistem autentikasi yang lengkap
- Struktur database yang mendukung fitur AI
- UI/UX yang menarik dengan fokus pada elemen AI
- Rencana penerapan algoritma prediksi AI

Meskipun beberapa fungsionalitas AI masih dalam tahap perencanaan, struktur database dan tampilan pengguna sudah menunjukkan integrasi AI sebagai fitur utama dari sistem ini.