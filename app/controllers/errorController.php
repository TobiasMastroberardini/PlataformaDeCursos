<?php
require_once './app/views/errorView.php';
class ErrorController{
    private $view;

    public function __construct(){
        $this->view = new ErrorView();
    }

    public function notFound(){
        $this->view->notFound();
    }
}