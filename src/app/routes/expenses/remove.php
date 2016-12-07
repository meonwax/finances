<?php
$app->get('/expenses/remove/{id}', function ($request, $response, $args) {
  $expense = Expense::find($args['id']);
  if(!$expense) {
    return $this->get('notFoundHandler')($request, $response);
  }
  $vars = [
    'expense' => $expense
  ];
  return $this->view->render($response, 'expense-remove.twig', $vars);
})->setName('removeExpense');

$app->post('/expenses/delete/{id}', function ($request, $response, $args) {
  $expense = Expense::find($args['id']);
  if($expense) {
    $expense->delete();
  }
  return $response->withRedirect($this->get('router')->pathFor('overview'));
})->setName('deleteExpense');
?>
