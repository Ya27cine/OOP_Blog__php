<?php 

namespace Controllers;

require_once("libraries/utils.php");
require_once("libraries/models/Article.php");
require_once("libraries/models/Comment.php");
require_once("libraries/controllers/AbstractController.php");



class Article extends AbstractController{
    protected $modelName = \Models\Article::class;

    public function index(){
        /**
         * 1. Récupération des articles
         */
        $articles = $this->model->findAll("created_at DESC");

        /**
         * 2. Affichage
         */
        $pageTitle = "Accueil";
        render("articles/index", compact('pageTitle','articles') );

        }



        public function show(){

            $commentModel = new \Models\Comment();

            /**
             * 1. Récupération du param "id" et vérification de celui-ci
             */
            // On part du principe qu'on ne possède pas de param "id"
            $article_id = null;

            // Mais si il y'en a un et que c'est un nombre entier, alors c'est cool
            if (!empty($_GET['id']) && ctype_digit($_GET['id'])) {
                $article_id = $_GET['id'];
            }

            // On peut désormais décider : erreur ou pas ?!
            if (!$article_id) {
                die("Vous devez préciser un paramètre `id` dans l'URL !");
            }

            /**
             * Récupération de l'article en question
             */
            $article =  $this->model->find( $article_id );

            /**
             *  Récupération des commentaires de l'article en question
             */
            $commentaires =  $commentModel->findAllByArticle($article_id);

            /**
             * 5. On affiche 
             */
            $pageTitle = $article['title'];
            render("articles/show",compact(
                    'pageTitle','article',
                    'article_id', 
                    'commentaires') 
            );

        }




        public function delete(){
                     
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
            $article = $this->model->find( $id );
            if ( ! $article) {
                die("L'article $id n'existe pas, vous ne pouvez donc pas le supprimer !");
            }
            
            /**
             * 4. Réelle suppression de l'article
             */
            $this->model->delete($id);
            
            /**
             * 5. Redirection vers la page d'accueil
             */
            redirect('index.php');
        }

}
?>