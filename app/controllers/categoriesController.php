<?php

class CategoriesController{
    private $model;
    private $viewCourse;

    public function __construct() {
        $this->model = new CategoriesModel();
    }

    public function getCategories(){
        $categories = $this->model->getAllCategories();
        return $categories;
    }

    public function getCategoryById($category_id){
        $category = $this->model->getCategoryById($category_id);
        return $category;
    }

    
}