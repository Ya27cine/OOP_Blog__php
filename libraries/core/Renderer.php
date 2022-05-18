<?php 
namespace Core;
class Renderer{

    public static function render($path, array $array){
        extract($array);
         ob_start();
         require('templates/'.$path.'.html.php');
         $pageContent = ob_get_clean();
         require('templates/layout.html.php');
     }
}

?>