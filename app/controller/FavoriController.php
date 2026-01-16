<?php

namespace app\controller;

require_once __DIR__ . '/../../vendor/autoload.php';

use app\model\Favori;


class FavoriController
{
    private Favori $favori;

    public function __construct()
    {
        if (!isset($_SESSION)) {
            session_start();
        }
        $this->favori = new Favori();
    }

    public function  run()
    {
        if ($this->isConnected()) {
            $this->changeStatus();
        } else {
            echo json_encode(['error' => "connexion"]);
        }
    }

    public function index()
    {
        header("Location: " . PATH_ROOT . "/");
    }

    private function isConnected(): bool
    {
        $connect = true;
        if (!isset($_SESSION['Utilisateur']) or  $_SESSION['Utilisateur']->getRole() !== 'client') {
            $connect =  false;
        }
        return $connect;
    }


    private function changeStatus()
    {
        header('Content-Type: application/json');
        if (!$this->isConnected()) {
            echo json_encode(['error' => "connexion"]);
            exit;
        }
        try {
            $this->remplerObject($this->favori, $_POST);
            if ($this->favori->isFavori($this->favori->getIdClient(), $this->favori->getIdVehicule())) {
                $this->favori->annulerFavori();
            } else {
                $this->favori->ajouterFavori();
            }
            echo json_encode(['success' => "success"]);
        } catch (\Exception $e) {
            echo json_encode(['success' => "failed"]);
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

(new FavoriController())->run();
