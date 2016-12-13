<?php
$app->get('/expenses[/]', function ($request, $response, $args) {
  $rows = $this->get('settings')['pager']['rows'];
  $expenses = Expense::orderBy('date', 'desc')->paginate($rows);
  $vars = [
    'expenses' => $expenses,
    'emptyRows' => count($expenses) - $rows
  ];
  return $this->view->render($response, 'overview.twig', $vars);
})->setName('overview');
