<?php
$app->get('/', function ($request, $response, $args) {
  // Just redirect to expenses overview for now
  return $response->withRedirect($this->get('router')->pathFor('overview'));
})->setName('home');
?>
