<?php
return [
  'settings' => [
    'displayErrorDetails' => true, // Set to false in production

    // Logging
    'logger' => [
      'name' => 'finances',
      'path' => __DIR__ . '/../../logs/app.log',
      'level' => \Monolog\Logger::DEBUG // Set to INFO in production
    ],

    // Database
    'db' => [
      'driver' => 'mysql',
      'host' => 'localhost',
      'database' => 'finances',
      'username' => 'finances',
      'password' => 's3cret',
      'charset'   => 'utf8',
      'collation' => 'utf8_unicode_ci',
      'prefix'    => ''
    ],

    // Pagination
    'pager' => [
      'rows' => 15,
      'visible-links' => 10
    ],

    // Locale
    'locale' => 'de_DE'
  ]
];
