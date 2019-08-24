<?php

class Core {

    public function run() {

        $url = explode('index.php', $_SERVER['PHP_SELF']);
        $url = end($url);

        $params = array();

        if (!empty($url)) {
            $url = explode('/', $url);
            array_shift($url);

            $currentController = $url[0] . 'Controller';
            array_shift($url);

            if (isset($url[0])) {

                $currentAtion = $url[0];
                array_shift($url);
            } else {
                $currentAtion = 'index';
            }
            if (count($url) > 0) {

                $params = $url;
            }
        } else {

            $currentController = 'homeController';
            $currentAtion = 'index';
        }
        require 'cores/Controller.php';
        if(!file_exists('controllers/'.$currentController.'.php') || !method_exists($currentController,$currentAtion)){
            $currentController = 'notfoundController';
            $currentAtion = 'index';
        }
        $c = new $currentController();
        call_user_func_array(array($c, $currentAtion), $params);
    }

}