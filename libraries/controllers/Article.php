<?php 

namespace Controllers;

require_once("libraries/utils.php");
require_once("libraries/models/Article.php");

class Article{

    public function index(){
        $articleModel = new \Models\Article();
        /**
         * 1. Récupération des articles
         */
        $articles = $articleModel->findAll("created_at DESC");

        /**
         * 2. Affichage
         */
        $pageTitle = "Accueil";
        render("articles/index", compact('pageTitle','articles') );

        }

        public function delete(){
         
            $articleModel = new \Models\Article();
            
            /**
             * 1. On vérifie que le GET possède bien un paramètre "id" (delete.php?id=202) et que c'est bien un nombre
             */
            if (empty($_GET['id']) || !ctype_digit($_GET['id'])) {
                die("Ho ?! Tu n'as pas précisé l'id de l'article !");
            }
            
            $id = $_GET['id'];
            
            /**
             * 3. Vérification que l'article existe bel et bien
             */
            $article = $articleModel->find( $id );
            if ( ! $article) {
                die("L'article $id n'existe pas, vous ne pouvez donc pas le supprimer !");
            }
            
            /**
             * 4. Réelle suppression de l'article
             */
            $articleModel->delete($id);
            
            /**
             * 5. Redirection vers la page d'accueil
             */
            redirect('index.php');
        }

}
?>