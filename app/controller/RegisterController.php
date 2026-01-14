<?php

namespace app\controler;

use app\model\Client;

class RegisterController
{
    private Client $client;

    public function __construct()
    {
        $this->client = new Client();
    }

    public function  index()
    {
        require_once __DIR__ . '/../view/register.php';
    }


    public function register()
    {

        $this->remplerObject($this->client, $_POST);
        $path =  $this->client->inscrire() ? "success" : "failed";
        header("Location: register/$path");
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
