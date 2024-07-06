<?php

require_once "./app/models/usersModel.php";
require_once "./app/helpers/authHelper.php";
require_once "./app/views/authView.php";



class AuthController{
    private $view;
    private $model;

    public function __construct(){ 
        $this->view = new AuthView();
        $this->model = new UsersModel();
    }

    public function showLogin($message = null){
        if(!AuthHelper::isLoggedIn()){
            $this->view->showLogin($message);
        }else{
            header('Location: ' . BASE_URL);
        }
    }

    public function login(){
        if(empty($_POST["email"]) || empty($_POST["password"])){ 
            $this->view->showLogin("Faltan datos por completar");
            die();
        }

        $user = $this->model->getUser();

        if(empty($user)){
            $this->view->showLogin("El usuario no existe");
        die();
        }

        if(!password_verify($_POST['password'], $user->password)){
            $this->view->showLogin("La contraseña es incorrecta");
            die();  
        }

        AuthHelper::login($user);
        header('Location: '. BASE_URL);
    }

    public function logout(){
        if(AuthHelper::isLoggedIn()){
            AuthHelper::logout();
        }
        header('Location: '. BASE_URL);

    }
}