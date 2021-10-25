## lumen-jwt-rest-api-with-front-end
Complete REST API with Lumen 8.x(with JWT) and Frontend integration Mini Project.Lumen is a PHP micro-framework built to deliver microservices and fast APIs.
Building a robust restful API in Lumen using JWT Authentication.

## How to use

1. Clone the repository with following path `C:\xampp\htdocs`
2. git clone `git clone https://github.com/hasmukh-dharajiya/lumen-jwt-rest-api-with-front-end.git`
3. Open `lumen-jwt-rest-api-with-front-end` 
4. Copy `.env.example file to .env`
5. Edit database credentials in .env file `DB_DATABASE=dashboard`
6. Run `composer install`
7. Run `php artisan jwt:secret`
8. Run `php artisan migrate`
9. Run `php -S localhost:8000 -t public`

`Note`: Replace Code Following path **'vendor/laravel/lumen-freamework/config/auth.php**':

```
<?php
return [
    'defaults' => [
        'guard' => env('AUTH_GUARD', 'api'),
        'passwords' => 'users',
    ],
   
    'guards' => [
        'web' => [
            'driver' => 'session',
            'provider' => 'users',
        ],

        'api' => [
            'driver' => 'jwt',
            'provider' => 'users',
            'hash' => false,
        ],
    ],
    'providers' => [
        'users' => [
            'driver' => 'eloquent',
            'model'  =>  App\Models\User::class,
        ]
    ],
    
    'passwords' => [
        //
    ],

];

```
10. Open xampp and Start Apache Server
11. Run **login.php** in lumen-jwt-rest-api-with-front-end/front-end-lumen-rest-api-jwt Folder `http://localhost/lumen-jwt-rest-api-with-front-end/front-end-lumen-rest-api-jwt/login.php`

## Register View
![larave dashboard img](public/images/dashboard-image/register.gif)

## Forgot Password View
![larave forgot_password img](public/images/dashboard-image/forgot-password.gif)

## dashboard View
![larave dashboard img](public/images/dashboard-image/dashboard.png)

