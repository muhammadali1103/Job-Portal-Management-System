# Setup Guide

## Requirements

- PHP 8.2+
- Composer
- MySQL (or SQLite)
- Node.js + npm (optional for frontend build)

## Install

```bash
git clone <repo-url>
cd Kuwait\ Jobs
composer install
cp .env.example .env
php artisan key:generate
```

## Configure Database

Edit `.env`:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=job_portal
DB_USERNAME=root
DB_PASSWORD=
```

## Migrate + Seed

```bash
php artisan migrate
php artisan db:seed
```

Optional demo seed:

```bash
php artisan db:seed --class="Database\\Seeders\\PakistanDemoSeeder"
```

## Run App

```bash
php artisan serve
```

Open: `http://127.0.0.1:8000`

## Admin Login

- Email: `admin@jobportal.com`
- Password: `11223344`

