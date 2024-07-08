<?php

class CoursesView
{

    public function showCurseById($course)
    {
        require './template/course.phtml';
    }
    public function showCourses($courses, $categories, $teachers)
    {
        require './template/coursesList.phtml';
    }

    public function updateCourse($course, $teachers, $categories)
    {
        require './template/editCourse.php';
    }

    public function deleteCourse($course_id)
    {
    }

    public function createCourse($teachers, $message, $categories)
    {
        require './template/addCourse.phtml';
    }

    public function showCoursesListAdmin($courses, $categories, $teachers)
    {
        require './template/coursesListAdmin.php';
    }
}