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
        header("Location: " . PATH_ROOT . "/");
    }

    public function default()
    {
        header("Location: " . PATH_ROOT . "/");
    }
    public function isConnected(string $role): bool
    {
        $connected = false;
        if (isset($_SESSION['Utilisateur']) && $_SESSION['Utilisateur']->getRole() === $role) {
            $connected = true;
        }
        return $connected;
    }

    public function add()
    {
        if ($this->isConnected('client') && $_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->remplerObject($this->avis, $_POST);
            $path = $this->avis->ajouterAvis() ? "success" : "failed";
            header("Location: " . PATH_ROOT . "/home/show/" . $_POST['idVehicule'] . "/addAvis/$path");
            exit();
        }
        header("Location: " . PATH_ROOT . "/home/show/" . $_POST['idVehicule']);
    }
    public function update()
    {
        if ($this->isConnected('client') && $_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->remplerObject($this->avis, $_POST);
            $path = $this->avis->modifierAvis() ? "success" : "failed";
            header("Location: " . PATH_ROOT . "/home/show/" . $_POST['idVehicule'] . "/update/$path");
            exit();
        }
        header("Location: " . PATH_ROOT . "/home/show/" . $_POST['idVehicule']);
    }

    public function delete()
    {
        if ($this->isConnected('client') && isset($_POST['idAvis'])) {
            $path = $this->avis->rejectReview((int)$_POST['idAvis']) ? "success" : "failed";
            header("Location: " . PATH_ROOT . "/home/show/" . $_POST['idVehicule'] . "delete/$path");
            exit;
        }
        header("Location: " . PATH_ROOT . "/home/show/" . $_POST['idVehicule']);
    }

    public function reject()
    {
        if ($this->isConnected('admin') && isset($_POST['idAvis'])) {
            $path = $this->avis->rejectReview((int)$_POST['idAvis']) ? "success" : "failed";
            header("Location: " . PATH_ROOT . "/dashboard/reviews/avis/delete/$path");
            exit;
        }
        header("Location: " . PATH_ROOT . "/dashboard/reviews");
    }

    public function approve()
    {
        if ($this->isConnected('admin') && isset($_POST['idAvis'])) {
            $path = $this->avis->approveReview((int)$_POST['idAvis']) ? "success" : "failed";
            header("Location: " . PATH_ROOT . "/dashboard/reviews/avis/approve/$path");
            exit;
        }
        header("Location: " . PATH_ROOT . "/dashboard/reviews");
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
