<?php
if (PHP_SAPI == 'cli-server') {
  // To help the built-in PHP dev server, check if the request was actually for
  // something which should probably be served as a static file
  $url  = parse_url($_SERVER['REQUEST_URI']);
  $file = __DIR__ . $url['path'];
  if (is_file($file)) {
    return false;
  }
}

require __DIR__ . '/../../vendor/autoload.php';

session_start();

// Instantiate the app
$settings = require __DIR__ . '/../app/config/settings.php';
$app = new \Slim\App($settings);

// Set up dependency injection container
require __DIR__ . '/../app/config/dependencies.php';

// Set up database
require __DIR__ . '/../app/config/db.php';

// Register ORM models
require __DIR__ . '/../app/models.php';

// Register middleware
require __DIR__ . '/../app/middleware.php';

// Register routes
require __DIR__ . '/../app/routes/home.php';
require __DIR__ . '/../app/routes/expenses/overview.php';
require __DIR__ . '/../app/routes/expenses/new.php';
require __DIR__ . '/../app/routes/expenses/edit.php';
require __DIR__ . '/../app/routes/expenses/remove.php';

// Run app
$app->run();