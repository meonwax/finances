<?php
// Home
$app->get('/', function ($request, $response, $args) {
  return $response->withRedirect('/expenses');
});

// Overview
$app->get('/expenses[/]', function ($request, $response, $args) {
  $expenses = Expense::orderBy('date', 'desc')->paginate(10);
  $vars = [
    'expenses' => $expenses,
    'totalPages' => ceil($expenses->total() / $expenses->perPage())
  ];
  return $this->view->render($response, 'overview.twig', $vars);
});

// New
$app->get('/expenses/new[/]', function ($request, $response, $args) {
  return $this->view->render($response, 'new.twig');
});

// Create
$app->post('/expenses', function ($request, $response, $args) {
  $allPostPutVars = $request->getParsedBody();
  $this->logger->debug('body: ' . $allPostPutVars);
  foreach($allPostPutVars as $key => $param){
    $this->logger->debug($key . " : " . $param);
  }
  return $response->withRedirect('/expenses');
});
?>
