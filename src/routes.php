<?php
// Home
$app->get('/', function ($request, $response, $args) {
  return $response->withRedirect('/expenses');
})->setName('home');

// Overview
$app->get('/expenses[/]', function ($request, $response, $args) {
  $rows = $this->get('settings')['pager']['rows'];
  $expenses = Expense::orderBy('date', 'desc')->paginate($rows);
  $vars = [
    'expenses' => $expenses,
    'emptyRows' => count($expenses) - $rows
  ];
  return $this->view->render($response, 'overview.twig', $vars);
})->setName('overview');

// New
$app->get('/expenses/new[/]', function ($request, $response, $args) {
  $vars = [
    'categories' => Category::orderBy('id')->get(),
    'persons' => Person::orderBy('id')->get()
  ];
  return $this->view->render($response, 'new.twig', $vars);
})->setName('newExpense');

// Create
$app->post('/expenses[/]', function ($request, $response, $args) {
  $data = $request->getParsedBody();
  $expense = new Expense;
  $expense->date = (new DateTime())->format('Y-m-d');
  $expense->price = $data['price'];
  $expense->description = $data['description'];
  $expense->category_id = $data['category'];
  $expense->person_id = $data['person'];
  $expense->save();
  return $response->withRedirect('/expenses');
})->setName('createExpense');
?>
