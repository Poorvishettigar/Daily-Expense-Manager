# Daily Expense Manager — Requirements & Setup

## Requirements
- XAMPP (includes Apache + MySQL / MariaDB) — tested with XAMPP on Windows (PHP 7.4+ recommended)
- phpMyAdmin (bundled with XAMPP)
- PHP extensions: `mysqli` (or PDO MySQL) enabled
- Web browser

## Files (project)
Place the uploaded project files into a folder under XAMPP's `htdocs`, e.g.:
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

##Image for reference:

`C:\xampp\htdocs\your-folder\`<img width="1125" height="519" alt="register" src="https://github.com/user-attachments/assets/cc8dc7ff-6588-42b8-ad31-faed9a6dd714" />
<img width="773" height="461" alt="signin" src="https://github.com/user-attachments/assets/246a8ab7-0cdb-4f5b-af9b-0ade0233f685" />
<img width="1179" height="889" alt="dem" src="https://github.com/user-attachments/assets/236e417c-90cc-459f-b643-cb6fa719820a" />
<img width="1765" height="251" alt="db" src="https://github.com/user-attachments/assets/d813e4b1-2c31-44da-acfe-d2c4968ab790" />


