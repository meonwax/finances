<?php
namespace App\Controller;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use App\Model\Expense;
use App\Model\Category;
use App\Model\Person;
use App\Helper\DateHelper;

class ExpenseController extends Controller {

  public function overview(Request $request, Response $response, $args) {
    $rows = $this->ci->get('settings')['pager']['rows'];
    $expenses = Expense::orderBy('date', 'desc')->paginate($rows);
    $vars = [
      'expenses' => $expenses,
      'categories' => Category::orderBy('id')->get(),
      'persons' => Person::orderBy('id')->get(),
      'months' => DateHelper::getMonths()
    ];
    return $this->view->render($response, 'overview.twig', $vars);
  }

  public function new(Request $request, Response $response, $args) {
    $vars = [
      'action' => 'new',
      'categories' => Category::orderBy('id')->get(),
      'persons' => Person::orderBy('id')->get()
    ];
    return $this->view->render($response, 'expense.twig', $vars);
  }

  public function create(Request $request, Response $response, $args) {
    $data = $request->getParsedBody();
    $expense = new Expense;
    $expense->date = $data['date'];
    $expense->price = $data['price'];
    $expense->description = $data['description'];
    $expense->category_id = $data['category'];
    $expense->person_id = $data['person'];
    $expense->save();
    return $response->withRedirect($this->router->pathFor('expense.overview'));
  }

  public function edit(Request $request, Response $response, $args) {
    $expense = Expense::find($args['id']);
    if(!$expense) {
      return $this->get('notFoundHandler')($request, $response);
    }
    $vars = [
      'action' => 'edit',
      'expense' => $expense,
      'categories' => Category::orderBy('id')->get(),
      'persons' => Person::orderBy('id')->get()
    ];
    return $this->view->render($response, 'expense.twig', $vars);
  }

  public function update(Request $request, Response $response, $args) {
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
    return $response->withRedirect($this->get('router')->pathFor('expense.overview'));
  }

  public function remove(Request $request, Response $response, $args) {
    $expense = Expense::find($args['id']);
    if(!$expense) {
      return $this->get('notFoundHandler')($request, $response);
    }
    $vars = [
      'expense' => $expense
    ];
    return $this->view->render($response, 'expense-remove.twig', $vars);
  }

  public function delete(Request $request, Response $response, $args) {
    $expense = Expense::find($args['id']);
    if($expense) {
      $expense->delete();
    }
    return $response->withRedirect($this->get('router')->pathFor('expense.overview'));
  }
}
