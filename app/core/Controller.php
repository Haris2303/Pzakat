<?php 

class Controller {

  public function view($view, $data = []): void {
    require_once '../app/views/' . $view . '.php';
  }

  public function model($model_class): object {
    require_once '../app/models/' . $model_class . '.php';
    return new $model_class;
  }

}