<?php


class UsersModel {
    private $db;

    public function __construct() {
        try {
            $this->db = new PDO('mysql:host=' . MYSQL_HOST . ';dbname=' . MYSQL_DB . ';charset=utf8', MYSQL_USER, MYSQL_PASS);
        } catch (\Throwable $th) {   
        }
    }

    public function getUser() {
        $query = $this->db->prepare('SELECT * FROM users WHERE email = ?');
        $query->execute([$_POST['email']]);
        return $query->fetch(PDO::FETCH_OBJ);
    }

    public function registerUser(array $data) {
        $query = $this->db->prepare('INSERT INTO users (fullname, email, password) VALUES (?,?,?)');
        $query->execute($data);
    }
}