<?php 
    
require_once("libraries/autoload.php");

class Kernel{
    public static function process(){

        $controllerName = "article";
        $task = "index";

        if(isset($_GET['controller'])){
            $controllerName = ucfirst( $_GET['controller'] );
        }

        if(isset($_GET['task'])){
            $task =  $_GET['task'];
        }

        $controllerName = "\Controllers\\" . $controllerName;

        $controller = new $controllerName();
        $controller->$task();
    }
}

?>