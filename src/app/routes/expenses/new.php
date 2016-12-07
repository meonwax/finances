<?php
abstract class Action {
  const New = 0;
  const Edit = 1;
}

$app->get('/expenses/new[/]', function ($request, $response, $args) {
  $vars = [
    'action' => Action::New,
    'categories' => Category::orderBy('id')->get(),
    'persons' => Person::orderBy('id')->get()
  ];
  return $this->view->render($response, 'expense.twig', $vars);
})->setName('newExpense');

$app->post('/expenses[/]', function ($request, $response, $args) {
  $data = $request->getParsedBody();
  $expense = new Expense;
  $expense->date = $data['date'];
  $expense->price = $data['price'];
  $expense->description = $data['description'];
  $expense->category_id = $data['category'];
  $expense->person_id = $data['person'];
  $expense->save();
  return $response->withRedirect('/expenses');
})->setName('createExpense');
?>
