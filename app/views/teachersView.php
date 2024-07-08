<?php

class TeachersView{
    
    function showTeachers($teachers){
        require "./template/teachersList.phtml";
    }

    function showTeacherById($teacher, $courses, $categories){
        require "./template/teacher.phtml";
    }

    function showCreateTeacher($message){
        require "./template/addTeacher.phtml";
    }

    function showUpdateTeacher($teacher){
        require "./template/editTeacher.phtml";
    }

    function showTeachersListAdmin($teachers){
        require "./template/teacherListAdmin.php";
    }
}