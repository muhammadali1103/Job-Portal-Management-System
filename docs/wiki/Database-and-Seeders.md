# Database and Seeders

## Core Commands

```bash
php artisan migrate
php artisan migrate:fresh --seed
```

## Available Seeders

- `DatabaseSeeder`
- `TestJobsSeeder`
- `PakistanDemoSeeder`
- `DemoJobsSeeder`
- `AddMoreJobsSeeder`
- `AllLocationsSeeder`

Run a specific seeder:

```bash
php artisan db:seed --class="Database\\Seeders\\TestJobsSeeder"
```

## Clean Job Data (example)

Use carefully in local/dev:

```bash
php artisan tinker
```

Then truncate relevant tables (`jobs`, `applications`, `job_analytics`, `job_skill`) if needed.

