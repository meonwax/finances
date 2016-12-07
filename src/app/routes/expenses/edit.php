<?php
$app->get('/expenses/edit/{id}', function ($request, $response, $args) {
  $expense = Expense::find($args['id']);
  if(!$expense) {
    return $this->get('notFoundHandler')($request, $response);
  }
  $vars = [
    'action' => Action::Edit,
    'expense' => $expense,
    'categories' => Category::orderBy('id')->get(),
    'persons' => Person::orderBy('id')->get()
  ];
  return $this->view->render($response, 'expense.twig', $vars);
})->setName('editExpense');

$app->post('/expenses/{id}', function ($request, $response, $args) {
  $expense = Expense::find($args['id']);
  if($expense) {
    $data = $request->getParsedBody();
    $expense->date = $data['date'];
    $expense->price = $data['price'];
    $expense->description = $data['description'];
    $expense->category_id = $data['category'];
    $expense->person_id = $data['person'];
    $expense->save();
  }
  return $response->withRedirect($this->get('router')->pathFor('overview'));
})->setName('updateExpense');
?>
