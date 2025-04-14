*🛠️ Cara Install & Jalankan*
 1. Clone repo ini
git clone [https://github.com/usernamekamu/nama-repo.git](https://github.com/riffi023/inventaris_ukk.git)

 2. Masuk ke folder project
cd inventaris_ukk

 3. Install dependency backend
composer install

 4. Install dependency frontend (opsional kalau pakai Vite)
npm install && npm run dev

 5. Salin file .env
cp .env.example .env

 6. Generate key aplikasi
php artisan key:generate

 7. Atur konfigurasi database di .env

 8. Jalankan migrasi (dan seeder kalau ada)
    
php artisan migrate

php artisan db:seed --class=CreateUsersSeeder


 10. Jalankan server lokal
php artisan serve

*🌐 Akses Aplikasi*

Setelah menjalankan php artisan serve, buka di browser:

http://127.0.0.1:8000

*🔑 Akun Default (Jika Seeder Menyediakan)*

Email    : admin@gmail.com
Password : 12345678

Email    : user@gmail.com
Password : 12345678
