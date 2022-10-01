# Setup development environment
## 1. Requirements
- [PHP 7.3+](https://www.php.net/)
- [MySQL 5.7+](https://www.mysql.com/)
- [Composer](https://www.npmjs.com/)
## 2. Installation
### 2.1. Setup project 
- Inside the container, execute these commands:
```
composer install
```
- Execute the following command to copy the .env file:
```
cp .env.example .env
```
- Generate key for the project:
```
php artisan key:generate
```
### 2.2. Import database
- Create database `elearning`.
- Create tables and sample data for the database:
```
php artisan migrate
```
```
php artisan db:seed
```
### 2.3. Serving Laravel
```
php artisan serve
```

# Author
Hau NT
