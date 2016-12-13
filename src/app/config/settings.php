<?php
return [
  'settings' => [
    'displayErrorDetails' => true, // Set to false in production

    // Templates
    'renderer' => [
      'template_path' => __DIR__ . '/../../templates/'
    ],

    // Logging
    'logger' => [
      'name' => 'finances',
      'path' => __DIR__ . '/../../../../logs/app.log',
      'level' => \Monolog\Logger::DEBUG // Set to INFO in production
    ],

    // Database
    'db' => [
      'driver' => 'mysql',
      'host' => 'localhost',
      'database' => 'finances',
      'username' => 'root',
      'password' => 'default',
      'charset'   => 'utf8',
      'collation' => 'utf8_unicode_ci',
      'prefix'    => ''
    ],

    // Pagination
    'pager' => [
      'rows' => 10
    ],

    // Locale
    'locale' => 'de_DE'
  ]
];
