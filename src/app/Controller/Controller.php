<?php
namespace App\Controller;

use Interop\Container\ContainerInterface;

abstract class Controller {

  protected $ci;
  protected $settings;
  protected $router;
  protected $view;

  public function __construct(ContainerInterface $ci) {
    $this->ci = $ci;
    $this->router = $ci->get('router');
    $this->view = $ci->get('view');
    $this->settings = $ci->get('settings');
  }
}
