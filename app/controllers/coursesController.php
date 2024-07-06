<?php
require_once "./app/models/coursesModel.php";
require_once "./app/models/teachersModel.php";
require_once "./app/models/categoriesModel.php";
require_once "./app/views/teachersView.php";
require_once "./app/views/courseView.php";
require_once "./app/views/errorView.php";
class CoursesController{
private $model;
private $teacherModel;
private $modelCategories;
private $viewTeacher;
private $view;
private $errorView;

public function __construct(){
    $this->model = new CoursesModel();
    $this->teacherModel = new TeachersModel();
    $this->modelCategories = new CategoriesModel();
    $this->viewTeacher = new TeachersView();
    $this->view = new CoursesView();
    $this->errorView = new ErrorView();

}

public function showCoursesListAdmin(){
    $courses = $this->model->getAllCourses();
    $this->view->showCoursesListAdmin($courses);
}

public function getCategories(){
    $categories = $this->modelCategories->getAllCategories();
    return $categories;
}

public function getTeachers(){
    $teachers = $this->teacherModel->getAllTeachers();
    return $teachers;
}

function showCourses(){
    $teachers = $this->getTeachers();
    $categories = $this->getCategories();
    $courses = $this->model->getAllCourses();
    $this->view->showCourses($courses, $categories, $teachers);
}

function showCourseById($course_id){
    $course = $this->model->getCoursesById($course_id);
    if($course) {
            $this->view->showCurseById($course);
    } else {
        $this->errorView->showError('El curso seleccionado no existe.');
    }
}

function showCoursesByTeacherId($teacher_id){
    $courses = $this->model->getCoursesByTeacherId($teacher_id);
    $teachers = $this->getTeachers();
    $categories = $this->getCategories();
    $this->view->showCourses($courses, $categories, $teachers);
}

public function showCoursesByCategory($category){
    $teachers = $this->getTeachers();
    $categories = $this->getCategories();
    $courses = $this->model->getCoursesByCategory($category);
    $this->view->showCourses($courses, $categories, $teachers);
}

public function showCoursesByCategoryAndTeacher($category, $teacher_id){
    $teacher = $this->teacherModel->getTeacherById($teacher_id);
    $categories = $this->getCategories();
    $courses = $this->model->getCoursesByCategoryAndTeacher($category, $teacher_id);
    $this->viewTeacher->showTeacherById($teacher, $courses, $categories);
}

function showUpdateCourse($course_id){
    $categories = $this->modelCategories->getAllCategories();
    $course = $this->model->getCoursesById($course_id);
    $teachers = $this->teacherModel->getAllTeachers();
    $this->view->updateCourse($course, $teachers, $categories);
}

function UpdateCourse($course_id){
    if(AuthHelper::isLoggedIn()){
        $data = [$_POST['categoty'], $_POST['description'], $_POST['link'], $_POST['teacher_id'], $_POST['title']];
        $this->model->updateCourse($data, $course_id);
    }
    header('Location: ' . BASE_URL);
}

function deleteCourse($course_id){
    if(AuthHelper::isLoggedIn()){
    $this->model->deleteCuouse($course_id);
    }
    header('Location: '. BASE_URL);
}

function showCreateCourse($message = null){
    $categories = $this->modelCategories->getAllCategories();
    $teachers = $this->teacherModel->getAllTeachers();
    $this->view->createCourse($teachers, $message, $categories);
}
function createCourse(){
     if(empty($_POST['title']) || empty($_POST['description']) || empty($_POST['category']) || empty($_POST['link']) || empty($_POST['teacher_id'])){
        $this->showCreateCourse("Faltan completar campos");
     }elseif(AuthHelper::isLoggedIn()){
        $data = [$_POST['category'], $_POST['description'], $_POST['link'], $_POST['teacher_id'], $_POST['title']];
        $this->model->createCuouse($data);
        header('Location: ' . BASE_URL);
     }else{
        header('Location: ' . BASE_URL);
     }
 }
}