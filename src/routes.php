<?php
$app->get('/', function ($request, $response, $args) {

  $expenses = Expense::orderBy('date', 'desc')->paginate(10);

  // $this->logger->info('total: ' . $expenses->total());

  $vars = [
    'expenses' => $expenses,
    'totalPages' => ceil($expenses->total() / $expenses->perPage())
  ];

  return $this->view->render($response, 'overview.twig', $vars);
});
?>
