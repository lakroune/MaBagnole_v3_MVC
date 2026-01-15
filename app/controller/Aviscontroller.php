<?php

namespace app\controller;

use app\model\Avis;
use app\model\Client;

class AvisController
{
    private Client $client;
    private Avis $avis;

    public function __construct()
    {
        $this->avis = new Avis();
        $this->client = new Client();
    }
    public function index()
    {
        echo "Avis";
    }


    public function delete()
    {
        if (isset($_POST['idAvis'])) {
            $path = $this->avis->rejectReview((int)$_POST['idAvis']) ? "success" : "failed";
            header("Location: " . PATH_ROOT . "/dashboard/reviews/avis/delete/$path");
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
