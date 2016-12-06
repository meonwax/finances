<?php

abstract class Action {
  const New = 0;
  const Edit = 1;
  const Remove = 2;
}

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
    'action' => Action::New,
    'categories' => Category::orderBy('id')->get(),
    'persons' => Person::orderBy('id')->get()
  ];
  return $this->view->render($response, 'expense.twig', $vars);
})->setName('newExpense');

// Edit
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

// Create
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

// Update
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
  return $response->withRedirect('/expenses');
})->setName('updateExpense');
?>
