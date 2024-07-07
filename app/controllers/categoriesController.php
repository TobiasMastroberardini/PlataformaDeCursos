<?php
require_once "./app/views/categoriesView.php";
class CategoriesController{
    private $model;
    private $view;

    public function __construct() {
        $this->model = new CategoriesModel();
        $this->view = new CategoriesView();
    }

    public function getCategories(){
        $categories = $this->model->getAllCategories();
        return $categories;
    }

    public function getCategoryById($category_id){
        $category = $this->model->getCategoryById($category_id);
        return $category;
    }

    function showCategoriesAdmin(){
        $categories = $this->getCategories();
        $this->view->showCategoriesAdmin($categories);
    }
}