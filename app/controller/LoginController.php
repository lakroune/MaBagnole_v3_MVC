<?php

namespace app\controller;

use app\model\Client;

class LoginController
{
    private Client $client;

    public function __construct()
    {
        session_start();
        $this->client = new Client();
    }
    public function index()
    {
        require_once __DIR__ . '/../view/login.php';
    }
    public function default()
    {
        require_once __DIR__ . '/../view/login.php';
    }

    public function login()
    {
        $this->remplerObject($this->client, $_POST);
        $path =  $this->client->seConnecter();
        if ($path == "client") {
            header("Location: " . PATH_ROOT . "/accueil");
        } else if ($path == "admin") {
            header("Location: " . PATH_ROOT . "/admin_dashboard");
        }
        header("Location: " . PATH_ROOT . "/login/failed");
    }
    private function remplerObject($object, $data)
    {
        foreach ($data as $key => $value) {
            $method = 'set' . ucfirst($key);
            if (method_exists($object, $method)) {
                $object->$method($value);
            }
        }
    }
}
