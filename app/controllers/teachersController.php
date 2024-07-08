<?php
require_once "./app/models/teachersModel.php";
require_once "./app/models/coursesModel.php";
require_once "./app/views/teachersView.php";
require_once "./app/controllers/ErrorController.php";
require_once "./app/controllers/categoriesController.php";
class TeachersController
{

    private $model;
    private $modelCourse;
    private $view;
    private $viewError;
    private $categoriesModel;

    public function __construct()
    {
        $this->model = new TeachersModel();
        $this->modelCourse = new CoursesModel();
        $this->view = new TeachersView();
        $this->viewError = new ErrorView();
        $this->categoriesModel = new CategoriesModel();
    }

    public function showTeachersListAdmin()
    {
        if (AuthHelper::isLoggedIn() && AuthHelper::isAdmin()) {
            $teachers = $this->model->getAllTeachers();
            $this->view->showTeachersListAdmin($teachers);
        }
    }

    function getAllTeachers()
    {
        $teachers = $this->model->getAllTeachers();
        $this->view->showTeachers($teachers);
    }

    function getTeacherById($teacher_id)
    {
        $categories = $this->categoriesModel->getAllCategories();
        $teacher = $this->model->getTeacherById($teacher_id);
        $courses = $this->modelCourse->getCoursesByTeacherId($teacher_id);
        $this->view->showTeacherById($teacher, $courses, $categories);
    }

    function createTeacher()
    {
        if (AuthHelper::isLoggedIn() && AuthHelper::isAdmin()) {

            if (empty($_POST['name']) || empty($_POST['profile_picture']) || empty($_POST['bio'])) {
                $this->showCreateTeacher("Faltan completar campos");
            } elseif (AuthHelper::isLoggedIn()) {
                $data = [$_POST["bio"], $_POST["name"], $_POST["profile_picture"]];
                $this->model->createTeacher($data);
                header('Location: ' . BASE_URL);

            } else {
                header('Location: ' . BASE_URL);
            }
        } else {
            echo "Debes ser admin para realizar estas acciones";
        }
    }

    function showCreateTeacher($message = null)
    {
        if (AuthHelper::isLoggedIn() && AuthHelper::isAdmin()) {
            $this->view->showCreateTeacher($message);
        } else {
            echo "Debes ser admin para realizar estas acciones";
        }
    }

    function updateTeacher($teacher_id)
    {
        if (AuthHelper::isLoggedIn() && AuthHelper::isAdmin()) {
            $data = [
                'name' => $_POST['name'],
                'profile_picture' => $_POST['profile_picture'],
                'description' => $_POST['description'],
                'bio' => $_POST['bio']
            ];

            $this->model->updateTeacher($data, $teacher_id);
        } else {
            echo "Debes ser admin para realizar estas acciones";
        }
    }

    function showUpdateTeacher($teacher_id)
    {
        if (AuthHelper::isLoggedIn() && AuthHelper::isAdmin()) {
            $teacher = $this->model->getTeacherById($teacher_id);
            $this->view->showUpdateTeacher($teacher);
        } else {
            echo "Debes ser admin para realizar estas acciones";
        }
    }

    function deleteTeacher($teacher_id)
    {
        if (AuthHelper::isLoggedIn() && AuthHelper::isAdmin()) {
            $couses = $this->modelCourse->getCoursesByTeacherId($teacher_id);
            if (count($couses) == 0) {
                $this->model->deleteTeacher($teacher_id);
            } else {
                $this->viewError->showError("Para eliminar a ese profesor debes eliminar los cursos que tenga");
            }
            header("Location: " . BASE_URL);
        } else {
            echo "Debes ser admin para realizar estas acciones";
        }
    }
}