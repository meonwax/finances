# Finances

#### My personal expenses tracking.

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

Point your virtual host document root to the application's `public/` directory and ensure `logs/` is web writeable.
