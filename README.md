# SIRA - Sistem Informasi RT/RW

<p align="center">
<img src="https://img.shields.io/badge/Laravel-11.x-red?logo=laravel" alt="Laravel Version">
<img src="https://img.shields.io/badge/PHP-8.2+-blue?logo=php" alt="PHP Version">
<img src="https://img.shields.io/badge/TailwindCSS-3.x-06B6D4?logo=tailwindcss" alt="Tailwind CSS">
<img src="https://img.shields.io/badge/Alpine.js-3.x-8BC0D0?logo=alpine.js" alt="Alpine.js">
</p>

## Tentang SIRA

SIRA (Sistem Informasi RT/RW) adalah aplikasi web modern yang dirancang untuk memudahkan pengelolaan administrasi RT/RW. Aplikasi ini menyediakan platform digital untuk mengelola data warga, pengajuan surat, pengaduan, dan iuran bulanan secara efisien dan terstruktur.

### Fitur Utama

#### 👤 Untuk Admin RT/RW
- **Dashboard Admin** - Ringkasan data dan statistik warga
- **Manajemen Data Warga** - CRUD data warga dengan verifikasi akun
- **Pengelolaan Surat Pengantar** - Review dan approve pengajuan surat warga
- **Manajemen Pengaduan** - Kelola pengaduan warga dengan update status
- **Iuran Bulanan** - Monitor dan kelola pembayaran iuran warga

#### 🏠 Untuk Warga
- **Dashboard Warga** - Informasi personal dan status layanan
- **Pengajuan Surat** - Ajukan surat pengantar secara online
- **Pengaduan** - Laporkan keluhan atau masalah di lingkungan RT/RW
- **Iuran Bulanan** - Cek dan bayar iuran bulanan

### Teknologi yang Digunakan

- **Backend**: Laravel 11.x dengan PHP 8.2+
- **Frontend**: Blade Templates dengan TailwindCSS
- **JavaScript**: Alpine.js untuk interaktivitas
- **Database**: SQLite (dapat diganti MySQL/PostgreSQL)
- **Authentication**: Laravel Breeze
- **Email**: Mailtrap untuk development

### Fitur Responsif

Aplikasi ini sepenuhnya responsif dengan:
- ✅ Hamburger menu untuk navigasi mobile
- ✅ Sidebar yang dapat dibuka/tutup di layar kecil
- ✅ Overlay backdrop untuk UX yang lebih baik
- ✅ Layout adaptif untuk tablet dan desktop
- ✅ Touch-friendly interface

## Instalasi

### Prasyarat
- PHP >= 8.2
- Composer
- Node.js & NPM
- SQLite/MySQL/PostgreSQL

### Langkah Instalasi

1. **Clone Repository**
```bash
git clone https://github.com/IQBAL-03/sira-app.git
cd sira-app
```

2. **Install Dependencies**
```bash
composer install
npm install
```

3. **Konfigurasi Environment**
```bash
copy .env.example .env
php artisan key:generate
```

4. **Konfigurasi Database**

Edit file `.env` dan sesuaikan konfigurasi database:
```env
DB_CONNECTION=sqlite
# atau untuk MySQL
# DB_CONNECTION=mysql
# DB_HOST=127.0.0.1
# DB_PORT=3306
# DB_DATABASE=sira
# DB_USERNAME=root
# DB_PASSWORD=
```

5. **Konfigurasi Email (Mailtrap)**

Edit file `.env` untuk konfigurasi email:
```env
MAIL_MAILER=smtp
MAIL_HOST=sandbox.smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=your_mailtrap_username
MAIL_PASSWORD=your_mailtrap_password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=noreply@sira.test
MAIL_FROM_NAME="${APP_NAME}"
```

6. **Konfigurasi Cloudinary (untuk upload gambar)**

Aplikasi ini menggunakan Cloudinary untuk menyimpan gambar (required untuk Vercel deployment).

Daftar gratis di: https://cloudinary.com/users/register_free

Tambahkan credentials ke `.env`:
```env
CLOUDINARY_CLOUD_NAME=your_cloud_name
CLOUDINARY_API_KEY=your_api_key
CLOUDINARY_API_SECRET=your_api_secret
CLOUDINARY_SECURE=true
```

📖 **Panduan lengkap:** Lihat file `CLOUDINARY_SETUP.md`

7. **Jalankan Migration dan Seeder**
```bash
php artisan migrate --seed
```

8. **Build Assets**
```bash
npm run build
# atau untuk development
npm run dev
```

9. **Jalankan Server**
```bash
php artisan serve
```

Aplikasi akan berjalan di `http://localhost:8000`

## Akun Default

Setelah menjalankan seeder, Anda dapat login dengan:

### Admin
- Email: `admin@gmail.com`
- Password: `Admin123`


## Struktur Aplikasi

```
app/
├── Http/
│   ├── Controllers/
│   │   ├── Admin/          # Controller untuk admin
│   │   ├── Warga/          # Controller untuk warga
│   │   └── Auth/           # Authentication controllers
│   └── Middleware/         # Custom middleware (Role, VerifiedWarga)
├── Models/                 # Eloquent models
├── Notifications/          # Email notifications
└── View/Components/        # Blade components

resources/
├── views/
│   ├── admin/             # Views untuk admin
│   ├── warga/             # Views untuk warga
│   ├── auth/              # Authentication views
│   ├── layouts/           # Layout templates (sidebar, topbar, app)
│   └── components/        # Reusable components
├── css/
└── js/

database/
├── migrations/            # Database migrations
└── seeders/              # Database seeders
```

## Development

### Menjalankan Development Server

```bash
# Terminal 1 - Laravel development server
php artisan serve

# Terminal 2 - Vite development server
npm run dev
```

### Build untuk Production

```bash
npm run build
```

### Membuat Migration Baru

```bash
php artisan make:migration create_table_name
php artisan migrate
```

### Membuat Controller Baru

```bash
# Resource controller
php artisan make:controller ControllerName --resource

# Controller untuk admin
php artisan make:controller Admin/ControllerName
```

## Deployment

Aplikasi ini dapat di-deploy ke:
- **Vercel** (sudah termasuk konfigurasi `vercel.json`)
- **Shared Hosting** (sudah termasuk `api/index.php` untuk hosting PHP)
- **VPS/Cloud** (DigitalOcean, AWS, Google Cloud, dll)

### Deploy ke Vercel

1. Pastikan semua code sudah di-commit ke GitHub
```bash
git add .
git commit -m "Prepare for deployment"
git push origin main
```

2. Import project di Vercel:
   - Login ke https://vercel.com
   - Klik **Add New** → **Project**
   - Import dari GitHub repository
   - Pilih repository `app-sira`

3. **Set Environment Variables** (PENTING!):

Sebelum deploy, tambahkan semua environment variables di **Settings** → **Environment Variables**:

```
APP_KEY=base64:xxx... (generate dengan: php artisan key:generate --show)
APP_ENV=production
APP_DEBUG=false
APP_URL=https://your-domain.vercel.app

DB_CONNECTION=mysql
DB_HOST=your-database-host
DB_PORT=your-database-port
DB_DATABASE=your-database-name
DB_USERNAME=your-database-username
DB_PASSWORD=your-database-password

CLOUDINARY_CLOUD_NAME=your_cloud_name
CLOUDINARY_API_KEY=your_api_key
CLOUDINARY_API_SECRET=your_api_secret
CLOUDINARY_SECURE=true

MAIL_MAILER=smtp
MAIL_HOST=your-mail-host
MAIL_PORT=587
MAIL_USERNAME=your-mail-username
MAIL_PASSWORD=your-mail-password
MAIL_ENCRYPTION=tls
```

📖 **Panduan lengkap Cloudinary:** Lihat file `CLOUDINARY_SETUP.md`
🔒 **Panduan keamanan:** Lihat file `.env.security-guide.md`

4. Klik **Deploy** dan tunggu proses selesai

5. Setelah deploy berhasil, jalankan migration dari local:
```bash
# Set DATABASE_URL dari Vercel
php artisan migrate --force
```

**⚠️ PENTING untuk Vercel:**
- File upload **HARUS** menggunakan Cloudinary (bukan local storage)
- Vercel menggunakan read-only filesystem
- Jangan simpan file ke `storage/` atau `public/` di production

## Kontribusi

Kontribusi selalu diterima! Silakan buat pull request atau laporkan issue yang Anda temukan.

## Lisensi

Aplikasi ini menggunakan framework Laravel yang berlisensi [MIT license](https://opensource.org/licenses/MIT).

## Kontak & Support

Jika Anda memiliki pertanyaan atau butuh bantuan, silakan buat issue di repository ini.
