<?php

namespace app\controller;

use app\model\Client;

class ClientsController
{
    private Client $client;

    public function __construct()
    {
        $this->client = new Client();
    }
    public function index()
    {
        echo "Avis";
    }


    public function Suspend()
    {
        if (isset($_POST['idClient'])) {
            $path = $this->client->suspendClient((int)$_POST['idClient']) ? "success" : "failed";
            header("Location: " . PATH_ROOT . "/dashboard/clients/suspend/$path");
            exit;
        }
    }

    public function activate()
    {
        if (isset($_POST['idClient'])) {
            $path = $this->client->activateClient((int)$_POST['idClient']) ? "success" : "failed";
            header("Location: " . PATH_ROOT . "/dashboard/clients/activate/$path");
            exit;
        }
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
