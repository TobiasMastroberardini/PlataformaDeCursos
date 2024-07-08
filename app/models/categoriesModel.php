<?php

class CategoriesModel
{
    public $db;

    public function __construct()
    {
        try {
            $this->db = new PDO('mysql:host=' . MYSQL_HOST . ';dbname=' . MYSQL_DB . ';charset=utf8', MYSQL_USER, MYSQL_PASS);
        } catch (PDOException $e) {
        }
    }

    public function getAllCategories()
    {
        $query = $this->db->prepare('SELECT * FROM categories');
        $query->execute();
        return $query->fetchAll(PDO::FETCH_OBJ);
    }

    public function createCategory($name)
    {
        // Preparar la consulta
        $query = $this->db->prepare('INSERT INTO categories (category_name) VALUES (?)');
        // Ejecutar la consulta con el nombre de la categoría
        $query->execute([$name]);
    }

    public function deleteCategory($category_id)
    {
        $query = $this->db->prepare('DELETE FROM categories WHERE category_id = ?');
        $query->execute([$category_id]);
    }


    public function getCategoryById($category_id)
    {
        $query = $this->db->prepare('SELECT * FROM categories WHERE category_id = ?');
        $query->execute([$category_id]);
        return $query->fetch(PDO::FETCH_OBJ);
    }

    public function updateCategory($category_id, $name)
    {
        $query = $this->db->prepare('UPDATE categories SET category_name = ? WHERE category_id = ?');
        return $query->execute([$name, $category_id]);
    }

}