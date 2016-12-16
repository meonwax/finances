<?php
$app->get('/', 'App\Controller\HomeController')->setName('home')->setName('home');

$app->get('/expenses[/]', 'App\Controller\ExpenseController:overview')->setName('expense.overview');

$app->get('/expenses/new[/]', 'App\Controller\ExpenseController:new')->setName('expense.new');
$app->post('/expenses[/]', 'App\Controller\ExpenseController:create')->setName('expense.create');

$app->get('/expenses/edit/{id}', 'App\Controller\ExpenseController:edit')->setName('expense.edit');
$app->post('/expenses/{id}', 'App\Controller\ExpenseController:update')->setName('expense.update');

$app->get('/expenses/remove/{id}', 'App\Controller\ExpenseController:remove')->setName('expense.remove');
$app->post('/expenses/delete/{id}', 'App\Controller\ExpenseController:delete')->setName('expense.delete');
