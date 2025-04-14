# 1. Clone repo ini
git clone https://github.com/usernamekamu/nama-repo.git

# 2. Masuk ke folder project
cd nama-repo

# 3. Install dependency backend
composer install

# 4. Install dependency frontend (opsional kalau pakai Vite)
npm install && npm run dev

# 5. Salin file .env
cp .env.example .env

# 6. Generate key aplikasi
php artisan key:generate

# 7. Atur konfigurasi database di .env

# 8. Jalankan migrasi (dan seeder kalau ada)
php artisan migrate
php artisan db:seed --class=CreateUsersSeeder


# 9. Jalankan server lokal
php artisan serve
