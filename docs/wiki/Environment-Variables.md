# Environment Variables

Key `.env` values:

```env
APP_NAME="Jobs Portal"
APP_ENV=local
APP_DEBUG=true
APP_URL=http://127.0.0.1:8000
```

## Database

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=job_portal
DB_USERNAME=root
DB_PASSWORD=
```

## Common Notes

- After changing env values:
  ```bash
  php artisan config:clear
  ```
- If Blade output is stale:
  ```bash
  php artisan view:clear
  ```

