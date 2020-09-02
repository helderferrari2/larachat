# LARACHAT

This repository contains the **project** , a simple real time chat made using Laravel, pusher and vuejs.

## Prerequisites

-   [laravel](http://laravel.com/)
-   [pusher](http://pusher.com/)
-   [vuejs](https://vuejs.org/)

## Installation

1. Clone the **_this repository_** to a location on your file system.
2. `cd` into the directoy, run `composer install`.
3. Copy `.env.example` to `.env`
4. Edit the `.env`, configure the database credentials
5. Run `php artisan key:generate`
6. Run `npm install`
7. Run the migrations `php artisan migrate:fresh --seed` to create tables in database
8. Run `php artisan serve` to start the server.
9. Run `npm run watch`
10. Navigate to `localhost:8000` in your browser.
