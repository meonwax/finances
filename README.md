# Finances

My personal expenses tracking using the PHP Slim Framework with Laravel's Eloquent as database provider and Twig as template engine.

## Setup

Install 3rd party dependencies using [Composer](https://getcomposer.org) dependency manager:

    composer install

Create database using the scripts in `db/`.

Customize configuration in `src/config/settings.php`.

## Development

To run in development use one of the following commands:

    composer start
    # or
    php -S 0.0.0.0:4000 -t src/public

Then open http://localhost:4000 in a web browser.

## Production

Point your virtual host document root to the application's `src/public/` directory and ensure `logs/` is web writeable.

Rename `src/app/settings-local.php.example` to `src/app/settings-local.php` and apply your production settings.
