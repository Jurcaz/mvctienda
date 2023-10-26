<?php

class Controller
{
    public function model($model)
    {
        include_once '../app/models/' . $model . '.php';
        return new $model();
    }

    public function view($view, $dataView = [])
    {
        if (file_exists('../app/views/' . $view . '.php')) {
            require_once '../app/views/' . $view . '.php';
        } else {
            die('La vista no existe...');
        }
    }


}