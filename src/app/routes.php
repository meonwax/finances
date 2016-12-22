<?php
$app->get('/', 'App\Controller\HomeController')->setName('home')->setName('home');

$app->get('/expenses[/]', 'App\Controller\ExpenseController:overview')->setName('expense.overview');

$app->get('/expenses/new[/]', 'App\Controller\ExpenseController:createGet')->setName('expense.createGet');
$app->post('/expenses[/]', 'App\Controller\ExpenseController:createPost')->setName('expense.createPost');

$app->get('/expenses/edit/{id}', 'App\Controller\ExpenseController:updateGet')->setName('expense.updateGet');
$app->post('/expenses/{id}', 'App\Controller\ExpenseController:updatePost')->setName('expense.updatePost');

$app->get('/expenses/remove/{id}', 'App\Controller\ExpenseController:deleteGet')->setName('expense.deleteGet');
$app->post('/expenses/delete/{id}', 'App\Controller\ExpenseController:deletePost')->setName('expense.deletePost');
