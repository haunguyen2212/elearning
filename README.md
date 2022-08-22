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
execute the following command to copy the .env file:
```
cp .env.example .env
```
```
php artisan key:generate
```
```
create database `elearning`;
```
### 2.2. Import database
```
php artisan migrate
```
```
php artisan db:seed
```
```
### 2.3. Serving Laravel
```
php artisan serve
```

# Author
Hau
