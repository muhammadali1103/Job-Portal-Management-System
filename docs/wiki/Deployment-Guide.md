# Deployment Guide

## Production Checklist

- Set `APP_ENV=production`
- Set `APP_DEBUG=false`
- Use strong DB credentials
- Configure correct `APP_URL`
- Run migrations
- Cache config/routes/views

## Commands

```bash
composer install --no-dev --optimize-autoloader
php artisan migrate --force
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

## File Permissions

Ensure writable:
- `storage/`
- `bootstrap/cache/`

## Web Server

Point document root to:
- `public/`

