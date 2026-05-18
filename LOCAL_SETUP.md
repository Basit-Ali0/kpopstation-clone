# Local setup with `kpopstation (1).sql`

This project is Laravel 12 (PHP ≥ 8.2) with Vite and Tailwind. The MySQL dump **is not shipped in this repo**—you need the file `kpopstation (1).sql` separately (same export you already use locally).

---

## 1. What you need installed

| Tool | Notes |
|------|------|
| **PHP 8.2+** | Enable extensions: `pdo_mysql`, `mbstring`, `openssl`, `tokenizer`, `xml`, `ctype`, `json`, `fileinfo` |
| **Composer** | [getcomposer.org](https://getcomposer.org/) |
| **Node.js 20+** (LTS) | npm included |
| **MySQL or MariaDB** | Server running; user with permission to create/use a database |

On Windows you can install PHP/MySQL via your preferred stack (Chocolatey, XAMPP, Laragon, WSL with Docker/MySQL, etc.).

---

## 2. Get the code

```bash
git clone https://github.com/Basit-Ali0/kpopstation-clone.git
cd kpopstation-clone
```

---

## 3. Create a database and import the dump

1. Create an empty database, for example named `kpopstation`:

   ```sql
   CREATE DATABASE kpopstation CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
   ```

2. Import the SQL file **from the filesystem path where you saved it** (quotes help with spaces):

   ```bash
   mysql -u YOUR_USER -p kpopstation < "/path/to/kpopstation (1).sql"
   ```

   Replace `YOUR_USER`, the database name, and the dump path.

   Alternatively use phpMyAdmin, MySQL Workbench, or DBeaver: choose the database → Import → pick `kpopstation (1).sql`.

After import, **do not expect the file contents to stay byte-identical forever**: Laravel may add columns when you migrate (see step 7).

---

## 4. Install PHP and JavaScript dependencies

```bash
composer install
npm install
```

---

## 5. Configure `.env`

1. Copy the example file:

   ```bash
   cp .env.example .env
   ```

   On Windows PowerShell: `Copy-Item .env.example .env`

2. Generate the app key:

   ```bash
   php artisan key:generate
   ```

3. Point Laravel at MySQL instead of SQLite. Set something like:

   ```env
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=kpopstation
   DB_USERNAME=your_mysql_user
   DB_PASSWORD=your_mysql_password
   ```

4. **Recommended after using a legacy dump**: use local file storage for session/cache so you are not blocked if the dump lacks Laravel’s cache/session/cache tables yet:

   ```env
   SESSION_DRIVER=file
   CACHE_STORE=file
   ```

   Leave `QUEUE_CONNECTION=database` or switch to `sync` locally if your DB has no Laravel job tables.

5. Adjust `APP_URL` to match how you browse the app:

   ```env
   APP_URL=http://127.0.0.1:8000
   ```

---

## 6. (Optional but useful) Sanity-check PHP ↔ MySQL

```bash
php artisan db:show
```

If credentials are wrong or the server is down, fix `.env` and retry.

---

## 7. Run migrations (schema vs your paste)

Imported data matches **what’s inside `kpopstation (1).sql`**. This repo ships an extra migration that adds **`sold_count`** to the `products` table (used on the storefront for sorting/display).

Run migrations:

```bash
php artisan migrate
```

**What can go wrong**

- **`table already exists` / duplicate schema errors**: the dump probably already defines many tables Laravel also creates in migrations, and Laravel’s `migrations` table may disagree with reality. Treat the dump as the source of truth and only apply what’s missing.
- **`sold_count` missing**: ensure that column exists. If full `migrate` is unsafe or noisy, apply only this file:

   ```bash
   php artisan migrate --path=database/migrations/2026_05_18_120000_add_sold_count_to_products_table.php
   ```

- **`sold_count` already in the dump**: that migration becomes a no-op if it was already marked run; if the column exists but Laravel still fails, inspect the error and coordinate with whoever maintains the migrations table.

Existing product rows normally get **`sold_count = 0`** when the column is added (unless your dump or scripts change that).

---

## 8. Do **not** run the default seeder unless you want fake data

To keep the storefront matching your SQL paste:

```bash
# Omit this for real dump data:
# php artisan db:seed
```

`DatabaseSeeder` creates sample categories/products and random values; it replaces the illusion of parity with production-style data unless you deliberately want demos.

---

## 9. Build assets and serve the site

Development (recommended while working on CSS/JS)—run in **two terminals** from `kpopstation-clone`:

**Terminal A**

```bash
npm run dev
```

**Terminal B**

```bash
php artisan serve
```

Open **`http://127.0.0.1:8000`** (or the host/port Laravel prints).

For a one-off build without watching files:

```bash
npm run build
php artisan serve
```

Visit the same URL.

---

## 10. Troubleshooting shortcuts

| Symptom | Try |
|---------|-----|
| `could not find driver` / PDO MySQL | Enable `pdo_mysql` in `php.ini`, restart CLI/web |
| Wrong DB / blank site | Confirm `.env` `DB_DATABASE` matches the DB you imported into |
| Assets look unstyled | Run `npm run dev` **or** `npm run build` so Vite manifests exist (`public/build`) |
| Product images gray / missing URLs | Imported `image` (or equivalent) rows may be `NULL`; fix data or placeholders in the Blade layer |
| Session / migration issues | Prefer `SESSION_DRIVER=file` locally; migrate only paths you need |

---

You now have local code + your **`kpopstation (1).sql`** data wired through `.env`; the app may still differ from production (checkout, CDN, uploads) wherever the live stack is not recreated.
