<?php

class generalView{
    public function showHome(){
        require_once "./template/home.phtml";
    }

     public function showRegister($message = null){
        require_once "./template/register.phtml";
    }
}