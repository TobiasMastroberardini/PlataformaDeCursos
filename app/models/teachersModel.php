<?php

class TeachersModel{
    private $db;

    public function __construct(){
        try {
            $this->db = new PDO('mysql:host=' . MYSQL_HOST . ';dbname=' . MYSQL_DB . ';charset=utf8', MYSQL_USER, MYSQL_PASS);
        } catch (PDOException $e) {
        }
    }

    public function getAllTeachers(){
         $query = $this->db->prepare('SELECT * FROM teachers');
        $query->execute();
        return $query->fetchAll(PDO::FETCH_OBJ);
    }

    public function getTeacherById($teacher_id){
        $query = $this->db->prepare('SELECT * FROM teachers WHERE teacher_id = ?');
        $query->execute([$teacher_id]);
        return $query->fetchAll(PDO::FETCH_OBJ);
    }

    public function createTeacher(array $data){
        $query = $this->db->prepare('INSERT INTO teachers (bio, name, profile_picture) VALUES (?,?,?)');
        $query->execute($data);
    }

 public function updateTeacher(array $data, $teacher_id) {
   $query = $this->db->prepare('UPDATE teachers SET name = ?, profile_picture = ?, description = ?, bio = ? WHERE teacher_id = ?');
        $query->execute([$data['name'], $data['profile_picture'], $data['description'], $data['bio'], $teacher_id]);
   
}

    public function deleteTeacher($teacher_id){
        $query = $this->db->prepare('DELETE FROM teachers WHERE teacher_id = ?');
        $query->execute([$teacher_id]);
    }
}