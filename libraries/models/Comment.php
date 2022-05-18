<?php 
namespace Models;

require_once("libraries/autoload.php");

class Comment extends Model {
    protected $table = "comments";

    /**
     * 4. Récupération des commentaires de l'article en question
     * Pareil, toujours une requête préparée pour sécuriser la donnée filée par l'utilisateur (cet enfoiré en puissance !)
     */
    function findAllByArticle(int $article_id){
        $query = $this->pdo->prepare("SELECT * FROM comments WHERE article_id = :article_id");
        $query->execute(['article_id' => $article_id]);
        $commentaires = $query->fetchAll();
        return $commentaires;
    }

    //  Insertion du commentaire
    function insert(array $comment){
        extract( $comment );
        $query = $this->pdo->prepare('INSERT INTO comments SET author = :author, content = :content, article_id = :article_id, created_at = NOW()');
        return $query->execute(compact('author', 'content', 'article_id'));
    }

}