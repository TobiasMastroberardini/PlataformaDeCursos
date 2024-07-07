<?php
require_once "./app/models/teachersModel.php";
require_once "./app/models/coursesModel.php";
require_once "./app/views/teachersView.php";
require_once "./app/controllers/ErrorController.php";
require_once "./app/controllers/categoriesController.php";
class TeachersController{

    private $model;
    private $modelCourse;
    private $view;
    private $viewError;
    private $categoriesModel;

    public function __construct(){
        $this->model = new TeachersModel();
        $this->modelCourse = new CoursesModel();
        $this->view = new TeachersView();
        $this->viewError = new ErrorView();
        $this->categoriesModel = new CategoriesModel();
    }

    public function showTeachersListAdmin(){
    $teachers = $this->model->getAllTeachers();
    $this->view->showTeachersListAdmin($teachers);
}

    function getAllTeachers(){
        $teachers = $this->model->getAllTeachers();
        $this->view->showTeachers($teachers);
    }

    function getTeacherById($teacher_id){
        $categories = $this->categoriesModel->getAllCategories();
        $teacher = $this->model->getTeacherById($teacher_id);
        $courses = $this->modelCourse->getCoursesByTeacherId($teacher_id);
        $this->view->showTeacherById($teacher, $courses, $categories);
    }

    function createTeacher(){
        if(empty($_POST['name']) || empty($_POST['profile_picture']) || empty($_POST['bio'])){
            $this->showCreateTeacher("Faltan completar campos");
        }elseif(AuthHelper::isLoggedIn()){
            $data = [$_POST["bio"], $_POST["name"], $_POST["profile_picture"]];
            $this->model->createTeacher($data);
            header('Location: ' . BASE_URL);

        }else{
            header('Location: ' . BASE_URL);
        }
    }

    function showCreateTeacher($message = null){
        $this->view->showCreateTeacher($message);
    }

    function updateTeacher($teacher_id){
        if(AuthHelper::isLoggedIn()){
            $data = [$_POST["name"], $_POST["email"], $_POST["bio"]];
            $this->model->updateTeacher($data, $teacher_id);
        }
        header("Location: ". BASE_URL);
    }

    function showUpdateTeacher($teacher_id){
        $teacher = $this->model->getTeacherById($teacher_id);
        $this->view->showUpdateTeacher($teacher);
    }

    function deleteTeacher($teacher_id){
        $couses = $this->modelCourse->getCoursesByTeacherId($teacher_id);
        if(count($couses) == 0 && AuthHelper::isLoggedIn()){
            $this->model->deleteTeacher($teacher_id);
        }else{
            $this->viewError->showError("Para eliminar a ese profesor debes eliminar los cursos que tenga");
        }
        header("Location: ". BASE_URL);
    }
}