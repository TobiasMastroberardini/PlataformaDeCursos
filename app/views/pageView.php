<?php

class PageView
{
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
        require_once "./template/adminHome.phtml";
    }
}