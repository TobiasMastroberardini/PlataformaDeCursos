<?php
require_once "./app/models/coursesModel.php";
require_once "./app/models/teachersModel.php";
require_once "./app/models/categoriesModel.php";
require_once "./app/views/teachersView.php";
require_once "./app/views/courseView.php";
require_once "./app/views/errorView.php";
class CoursesController
{
    private $model;
    private $teacherModel;
    private $modelCategories;
    private $viewTeacher;
    private $view;
    private $errorView;

    public function __construct()
    {
        $this->model = new CoursesModel();
        $this->teacherModel = new TeachersModel();
        $this->modelCategories = new CategoriesModel();
        $this->viewTeacher = new TeachersView();
        $this->view = new CoursesView();
        $this->errorView = new ErrorView();

    }

    public function showCoursesListAdmin()
    {
        $courses = $this->model->getAllCourses();
        $this->view->showCoursesListAdmin($courses);
    }

    public function getCategories()
    {
        $categories = $this->modelCategories->getAllCategories();
        return $categories;
    }

    public function getTeachers()
    {
        $teachers = $this->teacherModel->getAllTeachers();
        return $teachers;
    }

    function showCourses()
    {
        $teachers = $this->getTeachers();
        $categories = $this->getCategories();
        $courses = $this->model->getAllCourses();
        $this->view->showCourses($courses, $categories, $teachers);
    }

    function showCourseById($course_id)
    {
        $course = $this->model->getCoursesById($course_id);
        if ($course) {
            $this->view->showCurseById($course);
        } else {
            $this->errorView->showError('El curso seleccionado no existe.');
        }
    }

    function showCoursesByTeacherId($teacher_id)
    {
        $courses = $this->model->getCoursesByTeacherId($teacher_id);
        $teachers = $this->getTeachers();
        $categories = $this->getCategories();
        $this->view->showCourses($courses, $categories, $teachers);
    }

    public function showCoursesByCategory($category)
    {
        $teachers = $this->getTeachers();
        $categories = $this->getCategories();
        $courses = $this->model->getCoursesByCategory($category);
        $this->view->showCourses($courses, $categories, $teachers);
    }

    public function showCoursesByCategoryAndTeacher($category, $teacher_id)
    {
        $teacher = $this->teacherModel->getTeacherById($teacher_id);
        $categories = $this->getCategories();
        $courses = $this->model->getCoursesByCategoryAndTeacher($category, $teacher_id);
        $this->viewTeacher->showTeacherById($teacher, $courses, $categories);
    }

    function showUpdateCourse($course_id)
    {
        $categories = $this->modelCategories->getAllCategories();
        $course = $this->model->getCoursesById($course_id);
        $teachers = $this->teacherModel->getAllTeachers();
        $this->view->updateCourse($course, $teachers, $categories);
    }

    function UpdateCourse($course_id)
    {
        if (AuthHelper::isLoggedIn() && AuthHelper::isAdmin()) {
            if (empty($_POST['title']) || empty($_POST['category']) || empty($_POST['description']) || empty($_POST['teacher_id']) || empty($_POST['link']) || empty($_POST['minutes'])) {
                echo "faltan datps";
            } else {
                $data = [
                    'category' => $_POST['category'],
                    'description' => $_POST['description'],
                    'link' => $_POST['link'],
                    'teacher_id' => $_POST['teacher_id'],
                    'title' => $_POST['title'],
                    'minutes' => $_POST['minutes']
                ];
                $this->model->updateCourse($data, $course_id);
                header('Location: ' . BASE_URL);
            }
        } else {
            echo "Debes ser admin para realizar estas acciones";
        }
    }

    function deleteCourse($course_id)
    {
        if (AuthHelper::isLoggedIn() && AuthHelper::isAdmin()) {
            $this->model->deleteCourse($course_id);
            header('Location: ' . BASE_URL);
        } else {
            echo "Debes ser admin para realizar estas acciones";
        }

    }

    function showCreateCourse($message = null)
    {
        if (AuthHelper::isLoggedIn() && AuthHelper::isAdmin()) {
            $categories = $this->modelCategories->getAllCategories();
            $teachers = $this->teacherModel->getAllTeachers();
            $this->view->createCourse($teachers, $message, $categories);
        } else {
            echo "Debes ser admin para realizar estas acciones";
        }
    }
    function createCourse()
    {
        if (AuthHelper::isLoggedIn() && AuthHelper::isAdmin()) {
            if (empty($_POST['title']) || empty($_POST['description']) || empty($_POST['category']) || empty($_POST['link']) || empty($_POST['teacher_id']) || empty($_POST['minutes'])) {
                $this->showCreateCourse("Faltan completar campos");
            } else {
                $data = [
                    'category' => $_POST['category'],
                    'description' => $_POST['description'],
                    'link' => $_POST['link'],
                    'teacher_id' => $_POST['teacher_id'],
                    'title' => $_POST['title'],
                    'minutes' => $_POST['minutes']
                ];
                $this->model->createCourse($data);
                header('Location: courses-list-admin');
            }
        } else {
            echo "Debes ser admin para realizar estas acciones";
        }
    }


}