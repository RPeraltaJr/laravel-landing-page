## Laravel Landing Page

### Installation

This project uses version 5.8.28 of Laravel to run. 

To get started, make a clone of this project to your local machine.

Install all composer packages:

```
composer install
```

Install all npm packages:

```
npm install
```

Create a **.env** file (make a copy of **.env.example**) and update **DB_DATABASE**, **DB_USERNAME**, and **DB_PASSWORD**. Then run migrations:

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

### Register an Admin account

Navigate to **localhost:8000/admin**


### Unit Testing

Create an alias

```
alias pf="vendor/bin/phpunit --filter"
```

Run a specific method or class (see example below).

```
pf SubmissionsTest
```
or
```
pf guests_can_apply
```
