<?php

class CategoryModel{

    /* Méthode qui va renvoyer toutes les catégories */
    public function listAll() {
        $database = new Database(); // Connexion à la base de données

        return $database->query("SELECT * FROM categories");
    }

    public function add($name, $description, $picture) {
        $database = new Database();

        $database->executeSQL("INSERT INTO categories(categorie_name, categorie_description,categorie_picture) VALUES (?,?,?)",[$name, $description, $picture]);
    }

    public function find($id){
        $database = new Database();

        return $database->queryOne("SELECT * FROM categories WHERE idcategories = ?",[$id]);
    }
}