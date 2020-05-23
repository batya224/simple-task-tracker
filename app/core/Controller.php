<?php

/**
 * Base Controller class
 * Loads the Models and Views
 */
class Controller
{
    // Load model
    public function model($model)
    {
        require_once './app/models/' . $model . '.php';

        return new $model();
    }

    //Load view
    public function view($view, $data = array())
    {
        if (file_exists('./app/views/' . $view . '.php')) {

            require_once './app/views/' . $view . '.php';
            return;
        }

        die('View does not exist');

    }

    // public function get_template()
    // {
    //     if (file_exists('./app/view/single.php')) {
    //         # code...
    //     }
    // }
}
