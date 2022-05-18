<?php
namespace Core;
use PDO;

class DataBase{

    private static $_instance = null;

/** 
 * 1. Connexion à la base de données avec PDO
 * Attention, on précise ici deux options :
 * - Le mode d'erreur : le mode exception permet à PDO de nous prévenir violament quand on fait une connerie ;-)
 * - Le mode d'exploitation : FETCH_ASSOC veut dire qu'on exploitera les données sous la forme de tableaux associatifs
 */
    public static function getPdo(): PDO{    

        if(self::$_instance == null)
        {
            self::$_instance =   
                new PDO('mysql:host=127.0.0.1;dbname=blogpoo;charset=utf8', 'admin', 'root', [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
           ]);
        }

        return self::$_instance;
    }
}
?>