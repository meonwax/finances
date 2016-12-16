<?php
namespace App\Controller;

class HomeController extends Controller {

  public function __invoke($request, $response, $args) {
    // Just redirect to expenses overview for now
    return $response->withRedirect($this->router->pathFor('expense.overview'));
  }
}
