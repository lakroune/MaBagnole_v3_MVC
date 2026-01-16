<?php

namespace app\controller;

use app\model\Client;

class Logoutcontroller
{
    private Client $client;
    public function __construct()
    {
        $this->client = new Client();
    }
    public function index()
    {
        if ($this->client->seDeconnecter()) {
            header("Location: " . PATH_ROOT . "/");
        } else {
            header("Location: " . PATH_ROOT . "/login/failed");
        }
    }
}
