<?php

class AuthHelper{
    public static function  init(){
        if(session_status() == PHP_SESSION_NONE){
            session_start();
        }
    }

    public static function login($username){
        AuthHelper::init();
        $_SESSION['USER_USERNAME'] = $username->email;
    }

    public static function logout(){
        AuthHelper::init();
        session_destroy();
    }

    public static function isLoggedIn(){
        AuthHelper::init();
        return isset($_SESSION['USER_USERNAME']);
    }

     public static function isAdmin(){
        AuthHelper::init();
        return isset($_SESSION['USER_IS_ADMIN']) && $_SESSION['USER_IS_ADMIN'] == 1;
    }
}
