## Prerequisites

Before setting up the project, make sure you have the following installed:

- [PHP](https://www.php.net/) (recommended version: 8.2 or higher)
- [Composer](https://getcomposer.org/)
- [Node.js](https://nodejs.org/)
- [npm](https://www.npmjs.com/)
- `sqlite3` PHP extension (required for database)

To install the `sqlite3` PHP extension, follow the instructions based on your operating system:

- **For Ubuntu/Debian**:
  ```sudo apt-get install php-sqlite3```
- For Windows: Ensure that the php_sqlite3.dll extension is enabled in your php.ini file.

## How to run

1. Clone the repository ```git clone <repository-url> cd <project-directory>```
2. ```composer install```
3. ```npm install```
4. ```cp .env.example .env```
5. ```php artisan key:generate```
6. ```php artisan migrate```
7. ```php artisan serve```

This will start the Laravel development server, and you can access the application at http://127.0.0.1:8000.

