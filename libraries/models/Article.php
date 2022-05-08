<?php 
require_once("libraries/models/Model.php");

class Article extends Model{


function findAll(){
    $resultats = $this->pdo->query('SELECT * FROM articles ORDER BY created_at DESC');
    // On fouille le résultat pour en extraire les données réelles
   $articles = $resultats->fetchAll();
  return $articles;
}

  /**
 * 3. Récupération de l'article en question
 * On va ici utiliser une requête préparée car elle inclue une variable qui provient de l'utilisateur : Ne faites
 * jamais confiance à ce connard d'utilisateur ! :D
 */
function find(int $article_id){
    $query = $this->pdo->prepare("SELECT * FROM articles WHERE id = :article_id");

    // On exécute la requête en précisant le paramètre :article_id 
    $query->execute(['article_id' => $article_id]);

    // On fouille le résultat pour en extraire les données réelles de l'article
    $article = $query->fetch();
    return $article;
}


/**
 * 4. Réelle suppression de l'article
 */
function delete($id){
    $query = $this->pdo->prepare('DELETE FROM articles WHERE id = :id');
    return $query->execute(['id' => $id]);
}
}