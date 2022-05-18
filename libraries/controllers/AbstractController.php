<?php 

namespace Controllers;

abstract class AbstractController{
    protected $model;

    protected $modelName = '';

    public function __construct()
    {
        // TODO:
        $this->model = new $this->modelName();
    }
}

?>