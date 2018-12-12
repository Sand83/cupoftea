<?php

class AddcategorieController
{
    public function httpGetMethod(Http $http, array $queryFields)
    {
    	/*
    	 * Méthode appelée en cas de requête HTTP GET
    	 *
    	 * L'argument $http est un objet permettant de faire des redirections etc.
    	 * L'argument $queryFields contient l'équivalent de $_GET en PHP natif.
    	 */
    }

    public function httpPostMethod(Http $http, array $formFields)
    {
        //Traitement de l'image
        //Ajout de la photo dans le répertoire
        if ($http->hasUploadedFile('picture'));{
            $picture = $http->moveUploadedFile('picture','/images/tea');//On déplace la photo à l'endroit désiré(le chemin est relatif par rapport au dossier www)
        }                        
        // Enregistrer les données dans la base de données
        $categoryModel = new CategoryModel();
        //Ajout des données dans la BDD
        $categoryModel->add($formFields['name'], $formFields['contents'], $picture);
        //Ajout du flashbag
        $flashbag = new Flashbag();
        $flashbag->add('La catégorie '.$formFields['name'].' a bien été ajoutée');
        //Redirection vers la liste des catégories
        $http->redirectTo('admin/categories');
    }
}