# RentEase — Installation & Setup Guide

A Laravel 11 web application for property rental, roommate/tenant search, and reviews. This guide covers how to install and run the project locally using **XAMPP** on Windows.

> ⚠️ **Important:** This project is configured to use **Microsoft SQL Server** (`sqlsrv` driver), _not_ MySQL. XAMPP is used here to provide PHP and Apache; the database engine must be SQL Server (or SQL Server Express). See the [Database Setup](#4-database-setup-sql-server) section below.

---

## Tech Stack

- **Backend:** PHP ^8.2, Laravel ^11.31
- **Frontend:** Blade Templates, Javascript, CSS, Vite
- **Database:** Microsoft SQL Server (via `sqlsrv` / `pdo_sqlsrv` PHP extensions)
- **Package managers:** Composer (PHP), npm (Node.js)

---

## 1. Prerequisites

Install the following before you start:

| Tool                                                                                                                     | Recommended Version           | Notes                           |
| ------------------------------------------------------------------------------------------------------------------------ | ----------------------------- | ------------------------------- |
| [XAMPP](https://www.apachefriends.org/)                                                                                  | with PHP **8.2+**             | Provides Apache + PHP           |
| [Composer](https://getcomposer.org/download/)                                                                            | latest                        | PHP dependency manager          |
| [Node.js](https://nodejs.org/)                                                                                           | 18 LTS or newer               | Includes `npm`                  |
| [Microsoft SQL Server](https://www.microsoft.com/sql-server/sql-server-downloads)                                        | 2019 / 2022 (Express is fine) | Or SQL Server Developer Edition |
| [SQL Server Management Studio (SSMS)](https://learn.microsoft.com/sql/ssms/)                                             | latest                        | GUI to manage the DB            |
| [Microsoft ODBC Driver for SQL Server](https://learn.microsoft.com/sql/connect/odbc/download-odbc-driver-for-sql-server) | 17 or 18                      | Required by `sqlsrv`            |
| Git                                                                                                                      | latest                        | To clone the repository         |

---

## 2. Clone the Project into XAMPP

Place the project inside your XAMPP `htdocs` directory:

```powershell
cd C:\xampp\htdocs

git clone https://github.com/p3uj/Case-Study_Web_Dev_and_DBA_A.Y-2024-2025.git

cd Case-Study_Web_Dev_and_DBA_A.Y-2024-2025
```

---

## 3. Enable the `sqlsrv` PHP Extensions in XAMPP

Laravel uses the `sqlsrv` driver to talk to SQL Server. The required PHP extensions are **not** bundled with XAMPP and must be installed manually.

1.  Check your PHP version and thread-safety:
    ```powershell
    C:\xampp\php\php.exe -i | findstr /C:"PHP Version" /C:"Thread Safety" /C:"Architecture"
    ```
2.  Download the matching DLLs from the [Microsoft PHP Drivers for SQL Server](https://learn.microsoft.com/sql/connect/php/download-drivers-php-sql-server) page.
    If your php version is 8.2, download the **Windows_5.12.0RTW.zip** on this link [5.12.0 for PHP Driver for SQL Server](https://github.com/microsoft/msphpsql/releases/tag/v5.12.0). You need: - `php_sqlsrv_<version>_ts_x64.dll` - `php_pdo_sqlsrv_<version>_ts_x64.dll`

        (Use `ts` if Thread Safety = **enabled**, `nts` if disabled. Match your PHP version, e.g. 8.2 / 8.3.)

3.  Copy both DLLs into `C:\xampp\php\ext\`.
4.  Open `C:\xampp\php\php.ini` and add the following lines (near the other `extension=` entries):
    ```ini
    extension=php_sqlsrv_<version>_ts_x64.dll
    extension=php_pdo_sqlsrv_<version>_ts_x64.dll
    ```
5.  Install the [Microsoft ODBC Driver 17/18 for SQL Server](https://learn.microsoft.com/sql/connect/odbc/download-odbc-driver-for-sql-server).
6.  Restart Apache from the XAMPP Control Panel.
7.  Verify the extensions are loaded:
    ```powershell
    C:\xampp\php\php.exe -m | findstr sqlsrv
    ```
    You should see `sqlsrv` and `pdo_sqlsrv` listed.

---

## 4. Database Setup (SQL Server)

1. Open **SQL Server Management Studio (SSMS)** and connect to your local SQL Server instance.
2. Create a new empty database named **`RentEaseDB`**:
    ```sql
    CREATE DATABASE RentEaseDB;
    ```
3. Make sure **TCP/IP** is enabled and the server is listening on port **1433**:
    - Open _SQL Server Configuration Manager_ → _SQL Server Network Configuration_ → Protocols for SQLEXPRESS01.
    - Right click **TCP/IP** to enable, then double click → **IP Address** and look for **IPALL** then set **TCP Dynamic Ports** (leave blank), **TCP Port** to 1433 then click apply and ok.
    - Go to _SQL SERVER SERVICES_ → right click **SQL SERVER (SQLEXPRESS01)** then restart.
4. Verify **TCP/IP** is working
    - Open CMD and run: `netstat -ano | findstr 1433`
    - If you see LISTENING → TCP is enabled
5. Ensure a SQL login exists that can access the `RentEaseDB` database (either SQL authentication or your Windows account). You will use these credentials in the `.env` file.

---

## 5. Install PHP Dependencies

From the project root:

```powershell
composer install
```

---

## 6. Install Node.js Dependencies

```powershell
npm install
```

---

## 7. Configure Environment Variables

1.  Copy the example environment file:
    ```powershell
    copy .env.example .env
    ```
2.  Generate the application key:

    ```powershell
    php artisan key:generate
    ```

    > ⚠️ if the **APP_KEY** on your `.env` file did not automatically update, do this instead:

    ```powershell
    php artisan key:generate --show
    ```

    > ⚠️ then place the generated key to **APP_KEY** on your `.env` file

3.  Open `.env` and update the database section to match your local SQL Server setup:

    ```env
    DB_CONNECTION=sqlsrv
    DB_HOST=127.0.0.1
    DB_PORT=1433
    DB_DATABASE=RentEaseDB
    DB_USERNAME=your_sql_username
    DB_PASSWORD=your_sql_password
    ```

    > If you use a named SQL Server instance (e.g. `SQLEXPRESS`), set `DB_HOST=127.0.0.1\SQLEXPRESS` or configure the SQL Server Browser service and use the port directly.

    Run this after you setup your `.env` file:

    ```powershell
    php artisan optimize:clear
    ```

4.  (Optional) Test the connection with the helper script bundled in the repo:
    ```powershell
    C:\xampp\php\php.exe test_connection.php
    ```
    Edit the server / database names inside `test_connection.php` to match your environment before running it.

---

## 8. Run Migrations

The project ships with a large set of migrations that also create **stored procedures** and **views** used by the controllers. Run them all:

```powershell
php artisan cache:table
```

```powershell
php artisan migrate
```

If you ever need to start fresh:

```powershell
php artisan migrate:fresh
```

> ⚠️ `migrate:fresh` will drop all tables in the `RentEaseDB` database.

Create storage link:

```powershell
php artisan storage:link
```

---

## 9. Build Frontend Assets

For development (with hot reloading):

```powershell
npm run dev
```

For a production build:

```powershell
npm run build
```

---

## 10. Run the Application

You can run the project in two ways.

### Option A — Laravel's built-in server (recommended)

In one terminal:

```powershell
php artisan serve
```

In a second terminal (for Vite assets in development):

```powershell
npm run dev
```

Then open: <http://127.0.0.1:8000>

### Option B — Apache via XAMPP

1. Start **Apache** from the XAMPP Control Panel.
2. Build the production assets once: `npm run build`.
3. Visit: <http://localhost/Case-Study_Web_Dev_and_DBA_A.Y-2024-2025/public/>

For cleaner URLs, configure an Apache virtual host that points its `DocumentRoot` to the project's `public/` directory.

---

## Useful Commands

| Command                     | Purpose                                     |
| --------------------------- | ------------------------------------------- |
| `php artisan serve`         | Start the local PHP dev server              |
| `php artisan migrate`       | Run pending database migrations             |
| `php artisan migrate:fresh` | Drop all tables and re-run all migrations   |
| `php artisan route:list`    | Show all registered routes                  |
| `php artisan cache:clear`   | Clear application cache                     |
| `php artisan config:clear`  | Clear cached configuration                  |
| `npm run dev`               | Run Vite in development mode                |
| `npm run build`             | Build production frontend assets            |
| `composer dev`              | Run server + queue listener + Vite together |

---

## Troubleshooting

- **`could not find driver` / `PDOException: sqlsrv`**
  The `sqlsrv` / `pdo_sqlsrv` PHP extensions are not loaded. Re-check Step 3 and restart Apache. Confirm with `php -m | findstr sqlsrv`.

- **`SQLSTATE[08001] ... TCP Provider: No connection could be made`**
  SQL Server is not reachable. Verify the SQL Server service is running, **TCP/IP** is enabled, and port **1433** is open. Also confirm `DB_HOST` / `DB_PORT` in `.env`.

- **`Login failed for user`**
  Wrong credentials in `.env`, or the SQL login is disabled / not mapped to the `RentEaseDB` database. Fix it in SSMS under _Security → Logins_.

- **Vite assets not loading (blank styles)**
  Run `npm run dev` during development, or `npm run build` if serving through Apache.

- **`Class "..." not found` after pulling new code**
  Run `composer dump-autoload` and `php artisan config:clear`.

---

## Project Structure (high level)

```
app/                Application code (Controllers, Models, Helpers)
bootstrap/          Framework bootstrap files
config/             Configuration files (database, auth, etc.)
database/
  migrations/       Tables, stored procedures, and views
  seeders/          Database seeders
public/             Web server document root (index.php, assets)
resources/
  views/            Blade templates
  css/, js/         Frontend source files
routes/web.php      Web routes
tests/              Pest/PHPUnit tests
```

---

## License

This project is developed as a case study for the Web Development and Database Administration course (A.Y. 2024-2025).
