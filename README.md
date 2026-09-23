# LanderOS Landing Pages

## Local Setup

1. Copy `.env` and adjust the defaults that now target `http://localhost/all-projects/lander`, `lander2.0_db`, and your local timezone or credentials if they differ.
2. In phpMyAdmin (http://localhost/phpmyadmin) create a database named `lander2.0_db` if it does not exist already.
3. From the project root run `php database/auto_migrate.php`; it will replace the placeholder database name with whatever is configured in `.env` and seed the `admin_users` table (you can also import `database/migrations.sql` manually after replacing `{{DB_NAME}}` if needed).
4. Serve the project over `http://localhost/all-projects/lander` (or adjust `BASE_URL` in `.env` if you mount the folder elsewhere).

## Admin Access

- **URL:** `http://localhost/all-projects/lander/admin/login.php`
- **Email:** `admin@example.com`
- **Password:** `Admin@12345`

You can change the administrator details in phpMyAdmin after the first login or update the seed data in `database/migrations.sql` before importing.

## Tracking Control Center

- Manage Business Model, Tracking Plan (Essential · Robust · Elite), and all tracking credentials from **Admin → Ads Tracking Control Center** (`admin/api_tracking.php`).
- Essential renders a browser-side Meta Pixel, Robust adds automatic Meta Conversions API calls, and Elite swaps the pixel for a GTM container plus `dataLayer` pushes while still firing CAPI for deduplication.
- `config.php` + `tracking/helpers.php` expose helpers like `baby_katha_tracking_plan()` so templates (header, thank_you) can branch dynamically without manual edits.
- `process_order.php` stores a normalized payload in `$_SESSION['order_confirmation_data']`; `thank_you.php` consumes it to emit the right browser/server events and clears the session to prevent double fires.
- After flipping to Elite, import/configure the matching GTM container, bind the shared `event_id` to your Meta/GA4 tags, and verify in GTM Preview + Meta Test Events before launching any campaign.
