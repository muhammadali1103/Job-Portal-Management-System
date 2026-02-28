# Troubleshooting

## App shows old content

```bash
php artisan view:clear
php artisan config:clear
php artisan optimize:clear
```

## Database connection error

- Verify `.env` DB settings
- Ensure DB server is running
- Test credentials manually

## Missing key error

```bash
php artisan key:generate
```

## Route or cache issues after deploy

```bash
php artisan optimize:clear
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

## Permissions error

Set write permissions for:
- `storage`
- `bootstrap/cache`

