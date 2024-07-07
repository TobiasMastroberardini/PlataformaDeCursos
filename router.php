<?php 
require_once "config.php";
require_once "./app/controllers/coursesController.php";
require_once "./app/controllers/teachersController.php";
require_once "./app/controllers/usersController.php";
require_once "./app/controllers/authController.php";
require_once "./app/controllers/categoriesController.php";
require_once "./app/controllers/ErrorController.php";
require_once "./app/views/generalView.php";

define('BASE_URL', '//'.$_SERVER['SERVER_NAME'] . ':' . $_SERVER['SERVER_PORT'] . dirname($_SERVER['PHP_SELF']).'/');

$action = 'courses';

if(!empty($_GET['action'])){
$action = $_GET['action'];
}

$params = explode('/', $action);

switch($params[0]){
    case 'courses':
        $controller = new CoursesController();
        $controller->showCourses();
    break;
    case 'course':
        $controller = new CoursesController();
        $controller->showCourseById($params[1]);
        break;
    case 'courses-category':
        $controller = new CoursesController();
        $controller->showCoursesByCategory($params[1]);
        break;
    case 'courses-teacher':
        $controller = new CoursesController();
        $controller->showCoursesByTeacherId($params[1]);
        break;
    case 'courses-category-teacher':
        $controller = new CoursesController();
        $controller->showCoursesByCategoryAndTeacher($params[1], $params[2]);
        break;
    case 'add-course':
        $controller = new  CoursesController();
        $controller->showCreateCourse();
        break;  
    case 'added-course':
        $controller = new CoursesController();
        $controller->createCourse();
    case 'edit-course':
        $controller = new CoursesController();          
        $controller->deleteCourse($params[1]);
        break;
    case 'delete-course':
        $controller = new CoursesController();
        $controller->deleteCourse($params[1]);
        break;
    case 'teacher':
        $controller = new TeachersController();
        $controller->getTeacherById($params[1]);
        break;
    case 'teachers':
        $controller = new TeachersController();
        $controller->getAllTeachers();
        break;
    case 'add-teacher':
        $controller = new TeachersController();
        $controller->showCreateTeacher();
        break;
    case 'added-teacher':
        $controller = new TeachersController();
        $controller->createTeacher();
        break;
    case 'login':
        $controller = new AuthController();
        $controller->showLogin();
        break;
    case 'logout':
        $controller = new AuthController();
        $controller->logout();
        break;
    case 'auth':
        $controller = new AuthController();
        $controller->login();
        break;
    case 'home':
        $view = new GeneralView();
        $view->showHome();
        break;
    case 'register':
        $view = new GeneralView();
        $view->showRegister();
        break;
    case 'courses-list-admin':
        $controller = new CoursesController();
        $controller->showCoursesListAdmin();
        break;
    case 'teachers-list-admin':
        $controller = new TeachersController();
        $controller->showTeachersListAdmin();
        break;
    case 'categories-list-admin':
        $controller = new CategoriesController();
        $controller->showCategoriesAdmin();
        break;
    case 'register-user':
        $controller = new UsersController();
        $controller->registerUser();
        break;
    default:
    $controller = new ErrorController();
    $controller->notFound();
    break;
}