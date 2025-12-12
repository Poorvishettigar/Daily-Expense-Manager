# Expense Manager App — Requirements & Setup

## Requirements
- XAMPP (includes Apache + MySQL / MariaDB) — tested with XAMPP on Windows (PHP 7.4+ recommended)
- phpMyAdmin (bundled with XAMPP)
- PHP extensions: `mysqli` (or PDO MySQL) enabled
- Web browser

## Files (project)
Place the uploaded project files into a folder under XAMPP's `htdocs`, e.g.:
`C:\xampp\htdocs\your-folder\`

Example files included in this project:
- `index.php`, `eindex.php`, `register.php`, `login.php`, `expense_manager.php`, `db_connection.php`
- Frontend scripts/CSS: `script.js`, `escript.js`, `style.css`, `estyle.css`, etc. 
## name all the files as .php in htdocs folder except javascript and css.

## Setup steps

1. **Install XAMPP**
   - Download XAMPP from the official site and install.
   - During installation, allow Apache and MySQL services.

2. **Start services**
   - Open XAMPP Control Panel.
   - Start **Apache** and **MySQL** (both must be running before you open the app in the browser).

3. **Put project files in htdocs**
   - Copy the project folder (all `.php`, `.js`, `.css`, etc.) to:
     ```
     C:\xampp\htdocs\your-folder
     ```
   - Alternatively on Linux/Mac, `/opt/lampp/htdocs/your-folder` (or similar path).

4. **Create the database (phpMyAdmin)**
   - In your browser go to `http://localhost/phpmyadmin`
   - And create your database

5. **Configure DB connection**
   - Edit `db_connection.php` (or whichever DB file your project uses) to set DB credentials:
     - Host: `localhost`
     - Username: `root` (default for XAMPP)
     - Password: `''` (empty string) — unless you set a password
     - Database name: `your database name`

6. **Open the app**
   - After Apache & MySQL are running, go to:
     ```
     http://localhost/your-folder-name/your-file.php
     ```
   - Use the registration/login pages, then the expense manager.

## Troubleshooting
- If blank pages appear: enable PHP error reporting in `php.ini` or add at top of PHP files:
  ```php
  ini_set('display_errors', 1);
  error_reporting(E_ALL);
