<?php 
namespace Core;
class Http{
    public static function redirect(String $url): void{
        header("Location: $url");
        exit();
    }
}