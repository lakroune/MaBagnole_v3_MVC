<?php
class Router
{
    private $url;

    public function __construct($url)
    {
        $this->url = parse_url($url ?? "accueil", PHP_URL_PATH);
    }

    public function run()
    {
        $controllerName = !empty($this->url[0]) ? ucfirst($this->url[0]) . 'Controller' : 'HomeController';
        $methodName = isset($this->url[1]) ? $this->url[1] : 'index';
        $params = array_slice($this->url, 2);

        if (class_exists($controllerName)) {
            $controller = new $controllerName();
            if (method_exists($controller, $methodName)) {
                call_user_func_array([$controller, $methodName], $params);
            } else {
                $this->error404();
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
