# BPTP Library Guest Book

A web-based Library Guest Book application for the Assessment Institute for Agricultural Technology (BPTP) of South Kalimantan. This application is designed to replace conventional guest books, facilitating the recording and recapitulation of library visitor data.

## Key Features

- **Visitor Form**: Visitors can fill in their personal data, profession (General, Student, Employee), topic of interest, and purpose of visit.
- **Visit History**: Displays a list of registered visitor history.
- **Responsive Design**: User interface built with Bootstrap 5, accessible on both mobile and desktop devices.
- **Validation & Notifications**: Uses jQuery and SweetAlert2 for interactive input validation and notifications.

## Technology Stack

- **Programming Language**: PHP (Native)
- **Database**: MySQL
- **Frontend**: Bootstrap 5, HTML, CSS
- **JavaScript Libraries**: jQuery, SweetAlert2, Moment.js

## System Requirements

- PHP 7.4 or newer
- MySQL / MariaDB
- Web Server (Apache/Nginx/XAMPP/Laragon)

## Installation

Follow these steps to run the application on your local machine:

1.  **Clone Repository**
    ```bash
    git clone https://github.com/username/Buku-Tamu-Perpustakaan-BPTP.git
    cd Buku-Tamu-Perpustakaan-BPTP
    ```

2.  **Database Setup**
    - Create a new MySQL database named `bptp_library_guest_book`.
    - Import the provided database file located at `database/database.sql`.
    - You can use phpMyAdmin or the command line to import:
      ```bash
      mysql -u root -p bptp_library_guest_book < database/database.sql
      ```

3.  **Database Configuration**
    - Open the `database/connection.php` file.
    - Adjust the database configuration (hostname, username, password, and database name) if you use settings different from the default (root, empty password).
    ```php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "bptp_library_guest_book";
    ```

4.  **Base URL Configuration**
    - Open the `config/CONFIGURATION.php` file.
    - Adjust the `DEVELOPMENT_BASE_URL` constant to match your local server.
    ```php
    define("DEVELOPMENT_BASE_URL", "http://localhost/Buku-Tamu-Perpustakaan-BPTP/");
    ```
    - For production, set `IS_DEVELOPMENT` to `false` and configure `PRODUCTION_BASE_URL`.

5.  **Run Application**
    - Access the application via your browser at the configured address (e.g., `http://localhost/Buku-Tamu-Perpustakaan-BPTP/`).

## Project Structure

- `config/`: Application configuration (URL, constants).
- `database/`: SQL scripts and database connection.
- `assets/`: Images and other static files.
- `scripts/`: JavaScript files.
- `styles/`: CSS files.
- `ajax/`: Handlers for AJAX requests (backend logic).