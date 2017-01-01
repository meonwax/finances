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

    $params = $request->getQueryParams();

    $rows = $this->settings['pager']['rows'];
    $queryBuilder = Expense::orderBy('date', 'desc')
      ->when(!empty($params['category']), function($query) use($params) {
        return $query->where('category_id', $params['category']);
      })
      ->when(!empty($params['person']), function($query) use($params) {
        return $query->where('person_id', $params['person']);
      })
      ->when(!empty($params['month']), function($query) use($params) {
        return $query->whereMonth('date', $params['month']);
      })
      ->when(!empty($params['year']), function($query) use($params) {
        return $query->whereYear('date', $params['year']);
      });
    $priceSum = $queryBuilder->sum('price');
    $expenses = $queryBuilder->paginate($rows);

    $vars = [
      'params' => $params,
      'expenses' => $expenses->appends($params),
      'categories' => Category::orderBy('id')->get(),
      'persons' => Person::orderBy('id')->get(),
      'months' => DateHelper::getMonths(),
      'priceSum' => $priceSum
    ];
    return $this->view->render($response, 'overview.twig', $vars);
  }

  public function createGet(Request $request, Response $response, $args) {
    $vars = [
      'action' => 'new',
      'categories' => Category::orderBy('id')->get(),
      'persons' => Person::orderBy('id')->get()
    ];
    return $this->view->render($response, 'expense.twig', $vars);
  }

  public function createPost(Request $request, Response $response, $args) {
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

  public function updateGet(Request $request, Response $response, $args) {
    $expense = Expense::find($args['id']);
    if(!$expense) {
      return call_user_func($this->ci->get('notFoundHandler'), $request, $response);
    }
    $vars = [
      'action' => 'edit',
      'expense' => $expense,
      'categories' => Category::orderBy('id')->get(),
      'persons' => Person::orderBy('id')->get()
    ];
    return $this->view->render($response, 'expense.twig', $vars);
  }

  public function updatePost(Request $request, Response $response, $args) {
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
    return $response->withRedirect($this->router->pathFor('expense.overview'));
  }

  public function deleteGet(Request $request, Response $response, $args) {
    $expense = Expense::find($args['id']);
    if(!$expense) {
      return call_user_func($this->ci->get('notFoundHandler'), $request, $response);
    }
    $vars = [
      'expense' => $expense
    ];
    return $this->view->render($response, 'expense-remove.twig', $vars);
  }

  public function deletePost(Request $request, Response $response, $args) {
    $expense = Expense::find($args['id']);
    if($expense) {
      $expense->delete();
    }
    return $response->withRedirect($this->router->pathFor('expense.overview'));
  }
}
