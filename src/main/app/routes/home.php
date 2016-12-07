<?php
$app->get('/', function ($request, $response, $args) {
  return $response->withRedirect('/expenses');
})->setName('home');
?>
