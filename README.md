# SINOVEL API

REST API aplikasi baca novel (Laravel + MySQL + Sanctum).

## Cara menjalankan
1. `composer install`
2. `copy .env.example .env` lalu `php artisan key:generate`
3. Buat database kosong bernama `sinovel_db` di MySQL
4. `php artisan migrate --seed` (membuat tabel + mengisi 6 novel dan genre)
5. `php artisan serve` → API di http://127.0.0.1:8000/api

## Endpoint utama
- Auth: `POST /api/auth/register`, `POST /api/auth/login`, `GET /api/me`, `POST /api/auth/logout`
- Novel: `GET /api/novels`, `/api/novels/{id}`, `/api/novels/{id}/chapters`, `/api/novels/{id}/chapters/{no}`
- Library: `GET /api/me/library`, `PUT /api/me/progress/{id}`
- Daftar bacaan: `GET|POST /api/me/reading-lists`, `POST|DELETE /api/me/reading-lists/{id}/novels`
- Profil: `GET /api/me/profile`, `PUT /api/me`, `GET /api/me/activities`

Script migration ada di `database/migrations`, data awal di `database/seeders`.