# C230 Consultores website
## Instalation
*Run
```bash
composer install
```
on your cmd or terminal

*Copy .env.example file to .env on the root folder. You can type copy .env.example .env if using command prompt Windows or cp .env.example .env if using terminal, Ubuntu

*Open your .env file and change the database name (DB_DATABASE) to whatever you have, username (DB_USERNAME) and password (DB_PASSWORD) field correspond to your configuration.
By default, the username is root and you can leave the password field empty. (This is for Xampp)

*Run
```bash
php artisan key:generate
```

*Run
```bash
php artisan migrate
```

*Run
```bash
php artisan serve
```
