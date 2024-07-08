<?php
require_once "./app/views/categoriesView.php";
class CategoriesController
{
    private $model;
    private $view;

    public function __construct()
    {
        $this->model = new CategoriesModel();
        $this->view = new CategoriesView();
    }

    public function getCategories()
    {
        $categories = $this->model->getAllCategories();
        return $categories;
    }

    public function getCategoryById($category_id)
    {
        $category = $this->model->getCategoryById($category_id);
        return $category;
    }

    function showCategoriesAdmin()
    {
        if (AuthHelper::isLoggedIn() && AuthHelper::isAdmin()) {
            $categories = $this->getCategories();
            $this->view->showCategoriesAdmin($categories);
        } else {
            echo "Debes ser admin para realizar estas acciones";
        }
    }

    function showUpdateCategory($category_id)
    {
        if (AuthHelper::isLoggedIn() && AuthHelper::isAdmin()) {
            $category = $this->model->getCategoryById($category_id);
            $this->view->showUpdateCategory($category);
        } else {
            echo "Debes ser admin para realizar estas acciones";
        }
    }

    public function updateCategory($category_id)
    {
        if (AuthHelper::isLoggedIn() && AuthHelper::isAdmin()) {
            $name = $_POST['category_name'];
            if ($this->model->updateCategory($category_id, $name)) {
                header("Location: " . BASE_URL);
            }
        } else {
            echo "Debes ser admin para realizar estas acciones";
        }
    }

    public function showCreateCategory($message = null)
    {
        if (AuthHelper::isLoggedIn() && AuthHelper::isAdmin()) {
            $this->view->showCreateCategory($message);
        } else {
            echo "Debes ser admin para realizar estas acciones";
        }
    }

    function createCategory()
    {
        if (AuthHelper::isLoggedIn() && AuthHelper::isAdmin()) {
            $name = $_POST['category_name'];
            if (empty($name)) {
                $this->showCreateCategory("Falta completar el campo Nombre");
                header("Location: " . BASE_URL);
                die();
            }
            $this->model->createCategory($name);
            header("Location: categories-list-admin");
        } else {
            echo "Debes ser admin para realizar estas acciones";
        }

    }

    function deleteCategory($category_id)
    {
        if (AuthHelper::isLoggedIn() && AuthHelper::isAdmin()) {
            $this->model->deleteCategory($category_id);
        } else {
            echo "Debes ser admin para realizar estas acciones";
        }
    }
}