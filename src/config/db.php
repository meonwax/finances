<?php
use Illuminate\Pagination\Paginator;

// Bootstrap Eloquent ORM
$capsule = new \Illuminate\Database\Capsule\Manager;
$capsule->addConnection($container['settings']['db']);
$capsule->setAsGlobal();
$capsule->bootEloquent();

// Initialize paginator
Paginator::currentPageResolver(function ($pageName) {
  return empty($_GET[$pageName]) ? 1 : $_GET[$pageName];
});
?>
