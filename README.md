# BIJI

Website Perpustakaan

## Fitur-Fitur
Berikut adalah fitur-fitur yang ada pada proyek ini:
- **Login**
- **Register**
- **Forgot Password**
- **Searching**
- **Tambah Ke Favorite**
- **Hapus dari Favorite**
- **Detail Buku**
- **Chatbot Machine Learning**
- **Activate Account**
- **Riwayat**
- **Logout**
- **Add Buku**
- **Edit Buku**
- **Delete Buku**
- **Show Buku**
- **Search Buku Di admin**
- **Add Data Bot**
- **Delete Data Bot**
- **Search data bot di admin**
- **Terima peminjaman**
- **Tolak Peminjaman**
- **Search user di admin**
- **Pinjam Buku**
- **Change Email**
- **Change Username**

## Prasyarat

Sebelum menginstal proyek ini, pastikan Anda telah menginstal beberapa software berikut:
- PHP 8.2.x atau versi yang lebih baru
- Composer
- Laragon

## Instalasi

Ikuti langkah-langkah berikut untuk menginstal dan menjalankan proyek ini:

### 1. Clone Repositori
Clone repositori ini ke terminal kamu dengan perintah:
```bash
git clone https://github.com/username/nama-proyek.git
```

### 2. FILE ENV
buat file .env atau copy file .env.example
```bash
cp .env.example .env
```

### 3. Pastekan kode ini
Pastekan kode ini di .env yang baru saja dibuat
```bash
APP_NAME=BIJI
APP_ENV=local
APP_KEY=base64:n1C1ODi34gA//76/4/gtCNYO+6VuojLcFeNjWq1p78A=
APP_DEBUG=true
APP_TIMEZONE=UTC
APP_URL=http://localhost

APP_LOCALE=en
APP_FALLBACK_LOCALE=en
APP_FAKER_LOCALE=en_US

APP_MAINTENANCE_DRIVER=file
# APP_MAINTENANCE_STORE=database

PHP_CLI_SERVER_WORKERS=4

BCRYPT_ROUNDS=12

LOG_CHANNEL=stack
LOG_STACK=single
LOG_DEPRECATIONS_CHANNEL=null
LOG_LEVEL=debug

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=biji
DB_USERNAME=root
DB_PASSWORD=

SESSION_DRIVER=database
SESSION_LIFETIME=120
SESSION_ENCRYPT=false
SESSION_PATH=/
SESSION_DOMAIN=null

BROADCAST_CONNECTION=log
FILESYSTEM_DISK=local
QUEUE_CONNECTION=database

CACHE_STORE=database
CACHE_PREFIX=

MEMCACHED_HOST=127.0.0.1

REDIS_CLIENT=phpredis
REDIS_HOST=127.0.0.1
REDIS_PASSWORD=null
REDIS_PORT=6379

MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=yuuxdrestapi@gmail.com
MAIL_PASSWORD=howttyzdexihnmfd
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=biji@service.id
MAIL_FROM_NAME="${APP_NAME}"

AWS_ACCESS_KEY_ID=
AWS_SECRET_ACCESS_KEY=
AWS_DEFAULT_REGION=us-east-1
AWS_BUCKET=
AWS_USE_PATH_STYLE_ENDPOINT=false

VITE_APP_NAME="${APP_NAME}"

# JWT
JWT_SECRET=6WnZQV9iXt3mthMOuqgrz6GfAPAhjuzvJLsDIJu8yHF0f9PZLszt6JLSCNxfLUlL
```

### 4. Nama Database
ganti nama dabase menjadi **BIJI**

### 5. DATABASE
import database, kamu bisa ambil di folder BIJI - Database

### 6. APP KEY
jalankan perintah ini di terminal kamu
```bash
php artisan key:generate
```

### 7. Akun Admin
jalankan perintah ini di terminal kamu
```bash
php artisan db:seed
```

### 8. SERVER
jalankan perintah ini untuk melihat tampilan web
```bash
php artisan serve
```
