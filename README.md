<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventaris UKK Laravel</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            line-height: 1.6;
            margin: 0;
            padding: 20px;
            background-color: #f5f5f5;
        }
        .container {
            max-width: 800px;
            margin: 0 auto;
            background-color: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        h1 {
            color: #2c3e50;
            text-align: center;
            margin-bottom: 30px;
        }
        .description {
            text-align: center;
            color: #34495e;
            margin-bottom: 40px;
        }
        .section {
            margin-bottom: 30px;
        }
        .section-title {
            color: #2c3e50;
            border-bottom: 2px solid #3498db;
            padding-bottom: 10px;
            margin-bottom: 20px;
        }
        .installation-steps {
            background-color: #f8f9fa;
            padding: 20px;
            border-radius: 5px;
        }
        .step {
            margin-bottom: 15px;
        }
        .step code {
            background-color: #e9ecef;
            padding: 5px 10px;
            border-radius: 4px;
            display: block;
            margin: 10px 0;
        }
        .credentials {
            background-color: #e8f4f8;
            padding: 20px;
            border-radius: 5px;
            margin-top: 20px;
        }
        .emoji {
            font-size: 1.5em;
            margin-right: 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1><span class="emoji">📦</span>Inventaris UKK Laravel</h1>
        
        <div class="description">
            <p>Sistem manajemen inventaris sederhana menggunakan Laravel. Ikuti panduan di bawah untuk menjalankan proyek ini di lokal kamu.</p>
        </div>

        <div class="section">
            <h2 class="section-title"><span class="emoji">🛠️</span>Cara Install & Jalankan</h2>
            <div class="installation-steps">
                <div class="step">
                    <strong>1. Clone repositori</strong>
                    <code>git clone https://github.com/riffi023/inventaris_ukk.git</code>
                </div>

                <div class="step">
                    <strong>2. Masuk ke direktori project</strong>
                    <code>cd inventaris_ukk</code>
                </div>

                <div class="step">
                    <strong>3. Install dependency backend</strong>
                    <code>composer install</code>
                </div>

                <div class="step">
                    <strong>4. Install dependency frontend (opsional)</strong>
                    <code>npm install && npm run dev</code>
                </div>

                <div class="step">
                    <strong>5. Salin file environment</strong>
                    <code>cp .env.example .env</code>
                </div>

                <div class="step">
                    <strong>6. Generate application key</strong>
                    <code>php artisan key:generate</code>
                </div>

                <div class="step">
                    <strong>7. Konfigurasi database</strong>
                    <p>Buka file .env dan sesuaikan DB_DATABASE, DB_USERNAME, dan DB_PASSWORD</p>
                </div>

                <div class="step">
                    <strong>8. Jalankan migrasi dan seeder</strong>
                    <code>php artisan migrate

php artisan db:seed --class=CreateUsersSeeder</code>
</div>

                <div class="step">
                    <strong>9. Jalankan server lokal</strong>
                    <code>php artisan serve</code>
                </div>
            </div>
        </div>

        <div class="section">
            <h2 class="section-title"><span class="emoji">🌐</span>Akses Aplikasi</h2>
            <p>Setelah menjalankan php artisan serve, buka di browser:</p>
            <code>http://127.0.0.1:8000</code>
        </div>

        <div class="section">
            <h2 class="section-title"><span class="emoji">🔑</span>Akun Default</h2>
            <div class="credentials">
                <p><strong>Admin:</strong><br>
                Email: admin@gmail.com<br>
                Password: 12345678</p>

                <p><strong>User:</strong><br>
                Email: user@gmail.com<br>
                Password: 12345678</p>
            </div>
        </div>
    </div>

</body>
</html>
