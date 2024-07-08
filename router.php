<?php
require_once "config.php";
require_once "./app/controllers/coursesController.php";
require_once "./app/controllers/teachersController.php";
require_once "./app/controllers/usersController.php";
require_once "./app/controllers/authController.php";
require_once "./app/controllers/categoriesController.php";
require_once "./app/controllers/ErrorController.php";
require_once "./app/controllers/pageController.php";

define('BASE_URL', '//' . $_SERVER['SERVER_NAME'] . ':' . $_SERVER['SERVER_PORT'] . dirname($_SERVER['PHP_SELF']) . '/');

$action = 'home';

if (!empty($_GET['action'])) {
    $action = $_GET['action'];
}

$params = explode('/', $action);

switch ($params[0]) {
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
        $controller = new CoursesController();
        $controller->showCreateCourse();
        break;
    case 'create-course':
        $controller = new CoursesController();
        $controller->createCourse();
        break;
    case 'edit-course':
        $controller = new CoursesController();
        $controller->showUpdateCourse($params[1]);
        break;
    case 'update-course':
        $controller = new CoursesController();
        $controller->UpdateCourse($params[1]);
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
    case 'create-teacher':
        $controller = new TeachersController();
        $controller->createTeacher();
        break;
    case 'delete-teacher':
        $controller = new TeachersController();
        $controller->deleteTeacher($params[1]);
        break;
    case 'edit-teacher':
        $controller = new TeachersController();
        $controller->showUpdateTeacher($params[1]);
        break;
    case 'update-teacher':
        $controller = new TeachersController();
        $controller->updateTeacher($params[1]);
        break;
    case 'add-category':
        $controller = new CategoriesController();
        $controller->showCreateCategory();
        break;
    case 'create-category':
        $controller = new CategoriesController();
        $controller->createCategory();
        break;
    case 'edit-category':
        $controller = new CategoriesController();
        $controller->showUpdateCategory($params[1]);
        break;
    case 'update-category':
        $controller = new CategoriesController();
        $controller->updateCategory($params[1]);
        break;
    case 'delete-category':
        $controller = new CategoriesController();
        $controller->deleteCategory($params[1]);
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
        $controller = new PageController();
        $controller->showHome();
        break;
    case 'register':
        $controller = new PageController();
        $controller->showRegister();
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
    case 'home-admin':
        $controller = new PageController();
        $controller->showHomeAdmin();
        break;
    default:
        $controller = new ErrorController();
        $controller->notFound();
        break;
}