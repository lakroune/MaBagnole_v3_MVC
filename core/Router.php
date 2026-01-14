<?php

namespace core;

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
        echo $controllerName;
        $methodName = isset($this->url[1]) ? $this->url[1] : 'index';
        echo "/" . $methodName;
        $params = array_slice($this->url, 2);
        echo "/" . json_encode($params);

        if (class_exists($controllerName)) {
            echo " class exist";

            $controller = new $controllerName();
            if (method_exists($controller, $methodName)) {
                echo " method exist";
                call_user_func_array([$controller, $methodName], $params);
            } else {
                call_user_func_array([$controller, "default"], $params);
            }
        } else {
            $this->error404();
        }
    }

    private function error404()
    {
        echo "404 - Page non trouvée";
    }
}
