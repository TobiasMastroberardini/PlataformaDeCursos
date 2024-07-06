<?php
class CoursesModel{

    private $db;

    public function __construct(){
        try {
            $this->db = new PDO('mysql:host=' . MYSQL_HOST . ';dbname=' . MYSQL_DB . ';charset=utf8', MYSQL_USER, MYSQL_PASS);
        } catch (PDOException $e) {
        }
    }

    public function getAllCourses(){
        $query = $this->db->prepare('SELECT * FROM courses');
        $query->execute();
        return $query->fetchAll(PDO::FETCH_OBJ);
    }


  public function getCoursesById($course_id){
        $query = $this->db->prepare('SELECT * FROM courses WHERE course_id = ?');
        $query->execute([$course_id]);
        return $query->fetchAll(PDO::FETCH_OBJ);
    }

    public function getCoursesByCategory($category){
        $query = $this->db->prepare('SELECT * FROM courses WHERE category = ?');
        $query->execute([$category]);
        return $query->fetchAll(PDO::FETCH_OBJ);
    }

    public function getCoursesByTeacherId($teacher_id){
        $query = $this->db->prepare('SELECT * FROM courses WHERE teacher_id = ?');
        $query->execute([$teacher_id]);
        return $query->fetchAll(PDO::FETCH_OBJ);
    }

    public function getCoursesByCategoryAndTeacher($category, $teacher_id){
        $query = $this->db->prepare('SELECT * FROM courses WHERE category = ? AND teacher_id = ?');
        $query->execute([$category, $teacher_id]);
        return $query->fetchAll(PDO::FETCH_OBJ);
}


    public function createCuouse(array $data){
        $query = $this->db->prepare('INSERT INTO courses (category, description, link, teacher_id, title) VALUES (?,?,?,?,?)');
        $query->execute($data);
    }

    public function updateCourse(array $data, $course_id){
        $query = $this->db->prepare('UPDATE courses SET description = ?, link = ?, teacher_id = ?, title = ?');
        $query->execute([$data, $course_id]);
    }

    public function deleteCuouse($course_id){
        $query = $this->db->prepare('DELETE FROM courses WHERE course_id = ?');
        $query->execute([$course_id]);
    }
}