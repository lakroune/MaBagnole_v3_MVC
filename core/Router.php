<?php

namespace core;

use app\controller\NotfoundController;

class Router
{
    private  $url;

    public function __construct(array $url)
    {
        $this->url = $url;
    }

    public function run()
    {
        $path = "app\\controller\\";
        $controllerName = !empty($this->url[0]) ? $path . ucfirst($this->url[0]) . 'Controller' : $path . 'HomeController';
        $methodName = isset($this->url[1]) ? $this->url[1] : 'index';
        $params = array_slice($this->url, 2);
        echo $controllerName . " " . $methodName . " " . print_r($params, true);
        if (class_exists($controllerName)) {

            $controller = new $controllerName();
            if (method_exists($controller, $methodName)) {
                call_user_func_array([$controller, $methodName], $params);
            } else {
                call_user_func_array([$controller, 'default'], $params);
            }
        } else {
            call_user_func_array([new NotfoundController(), 'index'], $params);
        }
    }
}
