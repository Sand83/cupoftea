<?php

class CategoryModel{

    private $dbh;

    public function __construct(){
        $this->dbh = new Database();
    }
    /* Méthode qui va renvoyer toutes les catégories */
    public function listAll() {
       
        return $this->dbh->query("SELECT * FROM categories");
    }
    /* Méthode qui va ajouter une catégorie */
    public function add($name, $description, $picture) {

        $this->dbh->executeSQL("INSERT INTO categories(categorie_name, categorie_description,categorie_picture) VALUES (?,?,?)",[$name, $description, $picture]);
    }
    /* Méthode qui va trouver une catégorie */
    public function find($id){

        return $this->dbh->queryOne("SELECT * FROM categories WHERE idcategories = ?",[$id]);
    }
    /* Méthode qui va modifier une catégorie */
    public function update($id, $name, $description, $picture){

        $this->dbh->executeSQL("UPDATE categories SET categorie_name=?, categorie_description=? ,categorie_picture =? WHERE idcategories=?",[$name, $description, $picture, $id]); 
    }
    /* Méthode qui va supprimer une catégorie */
    public function delete($id){

        return $this->dbh->executeSQL("DELETE FROM categories WHERE idcategories=?",[$id]);
    }
}