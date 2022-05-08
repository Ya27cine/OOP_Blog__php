<?php

/**
 * 1. Connexion à la base de données avec PDO
 * Attention, on précise ici deux options :
 * - Le mode d'erreur : le mode exception permet à PDO de nous prévenir violament quand on fait une connerie ;-)
 * - Le mode d'exploitation : FETCH_ASSOC veut dire qu'on exploitera les données sous la forme de tableaux associatifs
 */
 function getPdo(): PDO{
    return new PDO('mysql:host=127.0.0.1;dbname=blogpoo;charset=utf8', 'admin', 'root', [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    ]);
}


function findAllArticles(){
    $pdo = getPdo();
    $resultats = $pdo->query('SELECT * FROM articles ORDER BY created_at DESC');
// On fouille le résultat pour en extraire les données réelles
   $articles = $resultats->fetchAll();
  return $articles;
}

  /**
 * 3. Récupération de l'article en question
 * On va ici utiliser une requête préparée car elle inclue une variable qui provient de l'utilisateur : Ne faites
 * jamais confiance à ce connard d'utilisateur ! :D
 */
function findAnArticle(int $article_id){
    $pdo = getPdo();
    $query = $pdo->prepare("SELECT * FROM articles WHERE id = :article_id");

    // On exécute la requête en précisant le paramètre :article_id 
    $query->execute(['article_id' => $article_id]);

    // On fouille le résultat pour en extraire les données réelles de l'article
    $article = $query->fetch();
    return $article;
}


 /**
 * 4. Récupération des commentaires de l'article en question
 * Pareil, toujours une requête préparée pour sécuriser la donnée filée par l'utilisateur (cet enfoiré en puissance !)
 */
function findAllComments(int $article_id){
    $pdo = getPdo();
    $query = $pdo->prepare("SELECT * FROM comments WHERE article_id = :article_id");
    $query->execute(['article_id' => $article_id]);
    $commentaires = $query->fetchAll();
    return $commentaires;
}

  /**
 * 5. Vérification de l'existence du commentaire
 */
function findOneComment(int $id){
    $pdo = getPdo();
    $query = $pdo->prepare('SELECT * FROM comments WHERE id = :id');
    $query->execute(['id' => $id]);
    return $query->fetch();
}

/**
 * 4. Suppression réelle du commentaire
 */
function deleteOneComment($id){
    $pdo = getPdo();
    $query = $pdo->prepare('DELETE FROM comments WHERE id = :id');
    return $query->execute(['id' => $id]);
}

/**
 * 4. Réelle suppression de l'article
 */
function deleteAnArticle($id){
    $pdo = getPdo();
    $query = $pdo->prepare('DELETE FROM articles WHERE id = :id');
    return $query->execute(['id' => $id]);
}


//  Insertion du commentaire
function addOneComment(array $comment){
    extract( $comment );
    $pdo = getPdo();
    $query = $pdo->prepare('INSERT INTO comments SET author = :author, content = :content, article_id = :article_id, created_at = NOW()');
    return $query->execute(compact('author', 'content', 'article_id'));
}

?>