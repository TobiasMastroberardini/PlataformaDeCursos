<?php
require_once './app/views/pageView.php';

class PageController
{
    private $view;

    public function __construct()
    {
        $this->view = new PageView();
    }
    public function showHome()
    {
        require_once "./template/home.phtml";
    }

    public function showRegister($message = null)
    {
        require_once "./template/register.phtml";
    }

    public function showHomeAdmin()
    {
        if (AuthHelper::isLoggedIn() && AuthHelper::isAdmin()) {
            $this->view->showHomeAdmin();
        } else {
            echo "Debes ser admin para realizar estas acciones";
        }
    }
}
