<?php
// Dependency injection container
$container = $app->getContainer();

// Twig template engine
$container['view'] = function($container) {
  $view = new \Slim\Views\Twig('../templates', [
    'cache' => false
  ]);

  // Instantiate and add Slim specific extension
  $basePath = rtrim(str_ireplace('index.php', '', $container['request']->getUri()->getBasePath()), '/');
  $view->addExtension(new Slim\Views\TwigExtension($container['router'], $basePath));

  // Add Intl extension¶
  $view->addExtension(new Twig_Extensions_Extension_Intl());

  // Add custom extensions
  $view->addExtension(new App\Extension\L10nExtension());

  return $view;
};

// Logger
$container['logger'] = function($container) {
  $settings = $container->get('settings')['logger'];
  $logger = new Monolog\Logger($settings['name']);
  $logger->pushProcessor(new Monolog\Processor\UidProcessor());
  $logger->pushHandler(new Monolog\Handler\StreamHandler($settings['path'], $settings['level']));
  return $logger;
};

// Override the default Not Found Handler
$container['notFoundHandler'] = function($container) {
  return function($request, $response) use($container) {
    return $container['view']->render($response, '404.twig')->withStatus(404);
  };
};

// Set default locale
Locale::setDefault($settings['settings']['locale']);

// Bootstrap Eloquent ORM
$capsule = new \Illuminate\Database\Capsule\Manager;
$capsule->addConnection($container['settings']['db']);
$capsule->setAsGlobal();
$capsule->bootEloquent();

// Initialize paginator
Illuminate\Pagination\Paginator::currentPageResolver(function ($pageName) {
  return empty($_GET[$pageName]) ? 1 : $_GET[$pageName];
});

// Set up a currentPathResolver so the paginator can generate proper links
Illuminate\Pagination\Paginator::currentPathResolver(function () {
  return isset($_SERVER['REQUEST_URI']) ? strtok($_SERVER['REQUEST_URI'], '?') : '/';
});
