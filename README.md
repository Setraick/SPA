# Dashboard
A dashboard created to be used has a tool in Softinsa's day to day work written in Laravel.

## Requisites
 * MySQL Server
 * PHP 

 *Note: A simple way to quickly install both of these (for a development environment) is with [xampp](https://www.apachefriends.org/index.html)*

 * Git Bash
 * [Composer](https://getcomposer.org/doc/00-intro.md#installation-windows) (PHP's package manager)

## Installation

1. Clone the repository
2. cd into the directory
3. Install composer dependencies
```
composer install
```
4. Copy the env file
```
cp .env.example .env
```
5. Generate app encryption key
```
php artisan key:generate
```
6. Create a MySQL database
7. Edit the `.env` file to contain the database info
8. Run the database migrations
```
php artisan migrate:refresh –seed
```

This also creates 1 test user1:
| Email                | Password    |
|----------------------|-------------|
| admin@admin.com      | qwertyui    |

9. Run the development server
```
php artisan serve
```
11.Open a new terminal
12. Install npm dependencies
```
npm install
```
13. Serve para compilar o código.
```
npm run hot
```

12. Access the app at http://localhost:8000
