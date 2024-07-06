<?php

class ErrorView{

    public function notFound(){
        require './template/notFound.phtml';
    }

    public function showError($message){
        require './template/notFound.phtml';
    }
}