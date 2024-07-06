<?php

class CoursesView{

    public function showCurseById($course){
        require './template/course.phtml';
    }
    public function showCourses($courses, $categories, $teachers){
        require './template/coursesList.phtml';
    }

    public function updateCourse($course_id, $teachers, $categories){
        
    }

    public function deleteCourse($course_id){
    }

    public function createCourse($teachers,$message, $categories){
                require './template/addCourse.phtml';
    }

    public function showCoursesListAdmin($courses){
        require './template/coursesListAdmin.php';
    }
}