<?php

class EditcategorieController
{
    public function httpGetMethod(Http $http, array $queryFields)
    {
    	/*
    	 * Méthode appelée en cas de requête HTTP GET
    	 *
    	 * L'argument $http est un objet permettant de faire des redirections etc.
    	 * L'argument $queryFields contient l'équivalent de $_GET en PHP natif.
    	 */
        $id = $queryFields['id'];

        $categoryModel = new CategoryModel();
        $categorie = $categoryModel->find($id);
        return[
            'categorie'=> $categorie
        ];

    }

    public function httpPostMethod(Http $http, array $formFields)
    {
        //Traitement de l'image

        if ($http->hasUploadedFile('picture'));{
            $picture = $http->moveUploadedFile('picture','/images/tea');//On déplace la photo à l'endroit désiré(le chemin est relatif par rapport au dossier www)
        }                        
        // Enregistrer les données dans la base de données
        $categoryModel = new CategoryModel();
        $categoryModel->add($formFields['name'], $formFields['contents'], $picture);
        $http->redirectTo('admin/categories');
    }
}