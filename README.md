# Panduan Instalasi dan Penggunaan Aplikasi Inventaris

## Langkah-langkah Instalasi

### 1. Clone repositori

```bash
git clone https://github.com/riffi023/inventaris_ukk.git
```

### 2. Masuk ke direktori project

```bash
cd inventaris_ukk
```

### 3. Install dependency backend

```bash
composer install
```

### 4. Install dependency frontend (opsional)

```bash
npm install && npm run dev
```

### 5. Salin file environment

```bash
cp .env.example .env
```

### 6. Generate application key

```bash
php artisan key:generate
```

### 7. Konfigurasi database

Buka file `.env` dan sesuaikan:

-   DB_DATABASE
-   DB_USERNAME
-   DB_PASSWORD

### 8. Jalankan migrasi dan seeder

```bash
php artisan migrate
php artisan db:seed --class=CreateUsersSeeder
```

### 9. Jalankan server lokal

```bash
php artisan serve
```

## 🌐 Akses Aplikasi

Setelah menjalankan `php artisan serve`, buka di browser:

http://127.0.0.1:8000

## 🔑 Akun Default (Jika Seeder Menyediakan)

| Role  | Email           | Password |
| ----- | --------------- | -------- |
| Admin | admin@gmail.com | 12345678 |
| User  | user@gmail.com  | 12345678 |
