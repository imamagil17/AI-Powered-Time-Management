# AI-Powered Time Management System

## Deskripsi Proyek

AI-Powered Time Management System adalah aplikasi berbasis web yang dirancang untuk membantu pengguna dalam melacak waktu kerja, memprediksi durasi tugas, dan meningkatkan produktivitas tim melalui integrasi kecerdasan buatan berbasis Large Language Model (LLM). Proyek ini dibangun menggunakan framework Laravel 12 dan berjalan di atas bahasa pemrograman PHP.

## Fitur Utama

- Pelacakan waktu real-time
- Prediksi durasi tugas menggunakan LLM
- Dashboard manajemen proyek
- Sistem autentikasi pengguna
- Manajemen tugas dan proyek
- Laporan produktivitas visual
- Integrasi kecerdasan buatan berbasis LLM
- Rekomendasi dan saran otomatis

## Teknologi yang Digunakan

- **Backend**: Laravel 12 Framework
- **Bahasa Pemrograman**: PHP 8.2
- **Database**: MySQL (dengan migrasi siap digunakan)
- **Frontend**: Blade Templates, Tailwind CSS, Alpine.js
- **Build Tool**: Vite
- **Testing**: PestPHP, PHPUnit
- **CSS Framework**: Tailwind CSS dengan plugin forms
- **Authentication**: Laravel Breeze (Login/Register)
- **AI/LLM Integration**: (Rencana pengembangan)

## Instalasi dan Setup

### Prasyarat Sistem

- PHP 8.2 atau lebih tinggi
- Composer (untuk manajemen dependensi PHP)
- Node.js dan npm (untuk asset build)
- Database MySQL (atau SQLite untuk development)
- Ekstensi PHP yang diperlukan: OpenSSL, PDO, Mbstring, Tokenizer, XML, Ctype, JSON, GD, BCMath

### Langkah-langkah Instalasi

1. **Clone repositori** (jika belum dilakukan):
   ```bash
   git clone <url_repositori>
   cd ai-powered-time-management
   ```

2. **Install dependensi PHP**:
   ```bash
   composer install
   ```

3. **Install dependensi Node**:
   ```bash
   npm install
   ```

4. **Konfigurasi environment**:
   ```bash
   cp .env.example .env
   ```

5. **Generate application key**:
   ```bash
   php artisan key:generate
   ```

6. **Konfigurasi database**:
   - Buka file `.env` dan sesuaikan pengaturan database:
     ```
     DB_CONNECTION=mysql
     DB_HOST=127.0.0.1
     DB_PORT=3306
     DB_DATABASE=ai_time_management
     DB_USERNAME=your_username
     DB_PASSWORD=your_password
     ```

7. **Jalankan migrasi database**:
   ```bash
   php artisan migrate
   ```

8. **(Opsional) Jalankan seeder untuk data awal**:
   ```bash
   php artisan db:seed
   ```

9. **Build aset frontend**:
   ```bash
   npm run build
   ```

10. **Jalankan server pengembangan**:
    ```bash
    php artisan serve
    ```

11. **(Opsional) Jalankan development server dengan Vite watcher**:
    ```bash
    npm run dev
    ```

### Setup untuk Pengembangan

Untuk pengembangan aktif, Anda dapat menggunakan perintah berikut dari package.json:

```bash
composer run dev
```

Perintah ini akan memulai:
- Server Laravel
- Queue listener
- Pail untuk log monitoring
- Vite development server

### Setup LLM Integration (Konfigurasi Environment)

Untuk mengaktifkan fitur LLM, tambahkan konfigurasi berikut di file `.env`:

```
OPENAI_API_KEY=your_openai_api_key
ANTHROPIC_API_KEY=your_anthropic_api_key  # opsional
LLM_PROVIDER=openai  # atau 'anthropic', 'ollama', dll
LLM_MODEL=gpt-4-turbo  # atau model lain yang didukung
```

## Penggunaan Aplikasi

### Autentikasi
1. Buka aplikasi di browser
2. Klik "Daftar Gratis" untuk membuat akun baru, atau "Masuk" jika sudah memiliki akun
3. Setelah login, Anda akan diarahkan ke dashboard

### Dashboard
- Melihat ringkasan aktivitas
- Akses cepat ke proyek dan tugas
- Statistik produktivitas

### Manajemen Proyek
- Navigasi ke halaman "Proyek"
- Tambah, edit, atau hapus proyek
- Monitor progres proyek

## Rencana Implementasi Fitur LLM

### 1. Prediksi Durasi Tugas (Task Duration Prediction)
**Deskripsi**: Menggunakan LLM untuk memprediksi berapa lama suatu tugas akan memakan waktu berdasarkan deskripsi tugas, sejarah pengguna, dan jenis tugas sebelumnya.

**Implementasi**:
- Buat service `TaskPredictionService` 
- Gunakan API OpenAI/GPT untuk menganalisis deskripsi tugas
- Simpan prediksi di kolom `ai_predicted_hours` di tabel tasks
- Bandingkan prediksi dengan durasi aktual untuk perbaikan berkelanjutan

**Komponen**:
- `TaskPredictionService`: Menganalisis deskripsi tugas dan menghasilkan prediksi
- `TaskPredictionController`: API endpoint untuk mendapatkan prediksi
- `PredictedDurationObserver`: Mengupdate prediksi saat tugas diselesaikan

### 2. Pembuatan dan Analisis Tugas Otomatis (Automatic Task Creation & Analysis)
**Deskripsi**: Memungkinkan pengguna memberikan deskripsi proyek atau goal besar, dan LLM akan membantu memecahnya menjadi tugas-tugas kecil yang terstruktur.

**Implementasi**:
- Endpoint API untuk mengirim deskripsi proyek
- Gunakan LLM untuk menghasilkan struktur tugas yang logis
- Simpan tugas-tugas yang dihasilkan ke database

**Komponen**:
- `TaskBreakdownService`: Membagi proyek besar menjadi tugas-tugas kecil
- `TaskGeneratorController`: Endpoint untuk pembuatan tugas otomatis

### 3. Saran dan Rekomendasi Produktivitas (Productivity Suggestions)
**Deskripsi**: Berdasarkan data waktu yang dihabiskan dan pola kerja pengguna, LLM memberikan saran untuk meningkatkan produktivitas.

**Implementasi**:
- Analisis data time entries pengguna
- Gunakan LLM untuk menghasilkan saran personal yang berguna
- Tampilkan saran di dashboard atau notifikasi

**Komponen**:
- `ProductivityAnalyzerService`: Menganalisis pola kerja pengguna
- `SuggestionGeneratorService`: Menghasilkan saran menggunakan LLM

### 4. Klasifikasi dan Pemahaman Tugas (Task Understanding and Classification)
**Deskripsi**: LLM akan membantu mengklasifikasikan jenis tugas, menentukan prioritas, dan memberikan label otomatis berdasarkan deskripsi tugas.

**Implementasi**:
- Analisis deskripsi tugas untuk klasifikasi otomatis
- Penentuan prioritas berdasarkan konten dan konteks
- Penambahan tag atau kategori otomatis

**Komponen**:
- `TaskClassificationService`: Mengklasifikasikan tugas berdasarkan deskripsi
- `PriorityPredictionService`: Memperkirakan prioritas tugas

### 5. Ringkasan dan Laporan (Summarization and Reporting)
**Deskripsi**: Secara otomatis menghasilkan ringkasan mingguan/bulanan dari aktivitas waktu yang dihabiskan, dengan wawasan dan rekomendasi.

**Implementasi**:
- Gunakan LLM untuk membuat ringkasan naratif dari data waktu
- Buat laporan yang mudah dipahami dan bermanfaat
- Sediakan opsi untuk laporan yang dipersonalisasi

**Komponen**:
- `TimeSummaryService`: Menghasilkan ringkasan aktivitas waktu
- `ReportGeneratorService`: Membuat laporan terperinci

### 6. Asisten Virtual untuk Manajemen Waktu (Virtual Time Management Assistant)
**Deskripsi**: Chat interface berbasis LLM yang dapat membantu pengguna mengelola waktu mereka, menjawab pertanyaan tentang produktivitas, dan memberikan saran secara interaktif.

**Implementasi**:
- UI chat untuk interaksi dengan LLM
- Context awareness tentang proyek dan tugas pengguna
- Fungsi untuk membuat, mengedit, atau menanyakan tentang tugas

**Komponen**:
- `ChatController`: Menangani permintaan chat dari frontend
- `AssistantService`: Inti dari logika asisten LLM
- `ChatMessageObserver`: Menyimpan percakapan ke database

### 7. Integrasi dengan Model Lokal (Local Model Integration)
**Deskripsi**: Opsi untuk menggunakan model LLM lokal seperti Ollama untuk privasi atau biaya.

**Implementasi**:
- Konfigurasi untuk berbagai provider LLM
- Toggle untuk penggunaan model lokal vs cloud
- Fallback mechanism jika API tidak tersedia

**Komponen**:
- `LLMProviderInterface`: Interface untuk berbagai provider LLM
- `OpenAIProvider`, `AnthropicProvider`, `OllamaProvider`: Implementasi spesifik

## Arsitektur Implementasi LLM

### Service Layer
```
app/
├── Services/
│   ├── AI/
│   │   ├── TaskPredictionService.php
│   │   ├── TaskBreakdownService.php
│   │   ├── ProductivityAnalyzerService.php
│   │   ├── SuggestionGeneratorService.php
│   │   ├── TaskClassificationService.php
│   │   ├── PriorityPredictionService.php
│   │   ├── TimeSummaryService.php
│   │   ├── ReportGeneratorService.php
│   │   └── AssistantService.php
│   ├── LLM/
│   │   ├── LLMProviderInterface.php
│   │   ├── OpenAIProvider.php
│   │   ├── AnthropicProvider.php
│   │   └── OllamaProvider.php
```

### Model Observers
```
app/
├── Observers/
│   ├── TaskObserver.php
│   ├── TimeEntryObserver.php
│   └── ChatMessageObserver.php
```

### Controllers
```
app/
├── Http/
│   ├── Controllers/
│   │   ├── API/
│   │   │   ├── AITaskPredictionController.php
│   │   │   ├── AITaskBreakdownController.php
│   │   │   ├── AISuggestionController.php
│   │   │   └── AIChatController.php
```

### Konfigurasi
```
config/
├── ai.php
├── llm.php
```

## Testing dan Validasi

### Unit Testing
- Tes untuk setiap service LLM
- Tes untuk akurasi prediksi
- Tes untuk keamanan dan validasi input

### Integration Testing
- Tes alur kerja end-to-end
- Tes dengan berbagai provider LLM
- Tes performance dan response time

## Keamanan dan Privasi

- Enkripsi data sensitif sebelum dikirim ke LLM
- Implementasi rate limiting untuk API LLM
- Pemfilteran informasi pribadi sebelum pengiriman ke LLM
- Log aktivitas LLM untuk audit

## Deployment

### Production
Untuk deployment ke production, ikuti langkah-langkah berikut:
```bash
# Build assets untuk production
npm run build

# Jalankan migrasi production
php artisan migrate --force

# Set production environment
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

### Environment Variables Penting
- `APP_KEY`: Generated saat instalasi
- `DB_*`: Konfigurasi database
- `OPENAI_API_KEY`: API key untuk integrasi OpenAI
- `LLM_*`: Konfigurasi lain untuk LLM

## Kontribusi

Jika Anda ingin berkontribusi pada proyek ini, silakan ikuti langkah-langkah berikut:

1. Fork repositori ini
2. Buat branch fitur baru (`git checkout -b fitur/NamaFitur`)
3. Commit perubahan Anda (`git commit -m 'Tambahkan beberapa fitur'`)
4. Push ke branch (`git push origin fitur/NamaFitur`)
5. Buka Pull Request

## Lisensi

Proyek ini dilisensikan di bawah Lisensi MIT - lihat file [LICENSE](LICENSE) untuk detail lebih lanjut.
