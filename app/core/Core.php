<?php

class Core
{
    protected $current_contoller = 'Tasks';
    protected $current_method = 'index';
    protected $params = array();


    function __construct()
    {
        $url = get_url();
        $data = null;

        $controller = ucwords($url[0]);
        if (file_exists('./app/controllers/' . $controller . '.php')) {
            $this->current_contoller = $controller;
            unset($url[0]);
        }

        // Require the controller
        require_once './app/controllers/' . $this->current_contoller . '.php';

        //Instantiate controller class
        $this->current_contoller = new $this->current_contoller($data);

        //Check if second param exists in controller
        if (isset($url[1])) {
            if (method_exists($this->current_contoller, $url[1])) {
                $this->current_method = $url[1];
                unset($url[1]);
            }
        }

        $this->params = $url ? array_values($url) : [];

        //Call a callback with array of params
        call_user_func_array([$this->current_contoller, $this->current_method], $this->params);
    }


}
