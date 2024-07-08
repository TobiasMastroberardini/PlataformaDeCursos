<?php

class CategoriesView
{

    public function showCategoriesAdmin($categories)
    {
        require "./template/categoryListAdmin.php";
    }

    public function showCreateCategory($message)
    {
        require "./template/addCategory.php";
    }

    public function showUpdateCategory($category)
    {
        require "./template/editCategory.php";
    }
}