<?php

 require_once("libraries/utils.php");
 require_once("libraries/models/Article.php");

 $articleModel = new Article();
/**
 * 1. Récupération des articles
 */
$articles = $articleModel->findAll("created_at DESC");

/**
 * 2. Affichage
 */
$pageTitle = "Accueil";
render("articles/index", compact('pageTitle','articles') );