<?php
return [
  'settings' => [
    'displayErrorDetails' => true, // Set to false in production
    'addContentLengthHeader' => false, // Allow the web server to send the content-length header

    // Templates
    'renderer' => [
      'template_path' => __DIR__ . '/../../templates/'
    ],

    // Logging
    'logger' => [
      'name' => 'finances',
      'path' => __DIR__ . '/../../logs/app.log',
      'level' => \Monolog\Logger::DEBUG
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
    ]
  ]
];
