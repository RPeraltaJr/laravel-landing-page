## Laravel Landing Page

### Installation

This project uses the latest version of Laravel to run (Laravel Framework 5.8.28). 

To get started, make a clone of this project to your local machine:

```
git clone https://github.com/RPeraltaJr/laravel-landing-page.git
```

Install all composer packages:

```
composer install
```

Create a **.env** file and update **DB_DATABASE**, **DB_USERNAME**, and **DB_PASSWORD**. Then run migrations:

```
php artisan migrate
```

Generate an Application Encryption Key:  

```
php artisan key:generate
```

Finally, run the project locally:

```
php artisan serve
```
