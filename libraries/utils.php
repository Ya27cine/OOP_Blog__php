<?php 

/**
 * render("articles/index")
 *
 * @return void
 */
function render($path, array $array){
   extract($array);
    ob_start();
    require('templates/'.$path.'.html.php');
    $pageContent = ob_get_clean();
    require('templates/layout.html.php');
}

function redirect(String $url): void{
    header("Location: $url");
    exit();
}



?>