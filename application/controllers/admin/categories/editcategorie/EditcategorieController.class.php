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
        //Récupération des données dans la vue
        $categoryModel = new CategoryModel();
        $categorie = $categoryModel->find($id);
        return[
            'categorie'=> $categorie
        ];

    }

    public function httpPostMethod(Http $http, array $formFields)
    {
        //Récupération de la photo originale
        if ($http->hasUploadedFile('picture')){
            $picture = $http->moveUploadedFile('picture','/images/tea');//On déplace la photo à l'endroit désiré(le chemin est relatif par rapport au dossier www)et on stocke dans la variable photo le nom du fichier
        }else{
            $picture = $formFields['originalpicture'];// Le nom de l'image reste le nom qui était là à l'origine
        }                    
        // Enregistrer les données dans la base de données
        $categoryModel = new CategoryModel();
        $categoryModel->update($formFields['id'], $formFields['name'], $formFields['contents'], $picture);
        //Ajout du flashbag
        $flashbag = new Flashbag();
        $flashbag->add('La catégorie '.$formFields['name'].' a bien été modifiée');
        //Redirection
        $http->redirectTo('admin/categories');
    }
}