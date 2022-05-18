<?php 
namespace Models;

use Core\DataBase;

abstract class Model{
    protected $pdo;
    protected $table;

    public function __construct()
    {
        $this->pdo = DataBase::getPdo();
    }

    function findAll(String $order = "" ){
        $sql = "SELECT * FROM {$this->table} ";
        if($order){
            $sql .= " ORDER BY  " . $order;
        }
        $resultats = $this->pdo->query($sql);
        // On fouille le résultat pour en extraire les données réelles
        $articles = $resultats->fetchAll();
        return $articles;
    }

     /**
       *  Récupération d'item en question
        */
    function find(int $id){
        $query = $this->pdo->prepare("SELECT * FROM {$this->table} WHERE id = :id");

        // On exécute la requête en précisant le paramètre :article_id 
        $query->execute(['id' => $id]);

        // On fouille le résultat pour en extraire les données réelles de l'article
        return $query->fetch();
    }

    /**
     *  Réelle suppression d'item
     */
    function delete($id){
        $query = $this->pdo->prepare("DELETE FROM {$this->table} WHERE id = :id");
        return $query->execute(['id' => $id]);
    }

}
?>