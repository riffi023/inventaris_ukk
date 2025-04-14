*🛠️ Cara Install & Jalankan*
# 1. Clone repositori
git clone https://github.com/riffi023/inventaris_ukk.git

# 2. Masuk ke direktori project
cd inventaris_ukk

# 3. Install dependency backend
composer install

# 4. Install dependency frontend (opsional)
npm install && npm run dev

# 5. Salin file environment
cp .env.example .env

# 6. Generate application key
php artisan key:generate

# 7. Konfigurasi database
# Buka file .env dan sesuaikan DB_DATABASE, DB_USERNAME, dan DB_PASSWORD

# 8. Jalankan migrasi dan seeder
php artisan migrate
php artisan db:seed --class=CreateUsersSeeder

# 9. Jalankan server lokal
php artisan serve

*🌐 Akses Aplikasi*

Setelah menjalankan php artisan serve, buka di browser:

http://127.0.0.1:8000

*🔑 Akun Default (Jika Seeder Menyediakan)*

Email    : admin@gmail.com
Password : 12345678

Email    : user@gmail.com
Password : 12345678
