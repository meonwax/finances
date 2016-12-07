<?php
// Dependency injection container
$container = $app->getContainer();

// Twig template engine
$container['view'] = function ($container) {
  $view = new \Slim\Views\Twig('../templates', [
    'cache' => false
  ]);

  // Instantiate and add Slim specific extension
  $basePath = rtrim(str_ireplace('index.php', '', $container['request']->getUri()->getBasePath()), '/');
  $view->addExtension(new Slim\Views\TwigExtension($container['router'], $basePath));

  // Set date formats
  $settings = $container->get('settings')['format'];
  $core = $view->getEnvironment()->getExtension('Twig_Extension_Core');
  $core->setDateFormat($settings['date']);
  $core->setTimezone($settings['timezone']);
  $core->setNumberFormat($settings['numbers']['decimals'], $settings['numbers']['decimal_point'], $settings['numbers']['thousands_separator']);

  return $view;
};

// Logger
$container['logger'] = function ($container) {
  $settings = $container->get('settings')['logger'];
  $logger = new Monolog\Logger($settings['name']);
  $logger->pushProcessor(new Monolog\Processor\UidProcessor());
  $logger->pushHandler(new Monolog\Handler\StreamHandler($settings['path'], $settings['level']));
  return $logger;
};

// Override the default Not Found Handler
$container['notFoundHandler'] = function ($container) {
  return function ($request, $response) use ($container) {
    return $container['view']->render($response, '404.twig')->withStatus(404);
  };
};
