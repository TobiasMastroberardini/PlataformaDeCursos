<?php
require_once "./app/models/usersModel.php";
// require_once "./app/views/usersView.php";
class UsersController{
    private $model;
    private $view;

    public function __construct(){
        $this->model = new UsersModel();
        // $this->view = new UsersView();
    }

    public function registerUser(){
        if(empty('fullname') || empty('email') || empty('password')){
            die();
        }
        $fullname = $_POST['fullname'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $data = [$fullname,$email,$password]; 
        $this->model->registerUser($data);
    }    
}