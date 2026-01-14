<?php

namespace app\controller;

use app\model\Categorie;
use app\model\Vehicule;

class VehiculesController
{
    private Vehicule $vehicule;
    private Categorie $categorie;

    public function __construct()
    {
        if (!$this->isConnected()) {
            header('Location: ' . PATH_ROOT);
            exit();
        }
        $this->vehicule = new Vehicule();
        $this->categorie = new Categorie();
    }

    public function index()
    {
        $categories = $this->categorie->getAllCategories();
        $vehicules = $this->vehicule->getAllVehicules();
        require_once __DIR__ . '/../view/admin_fleet.php';
    }
    private function isConnected(): bool
    {
        $connect = true;
        if (!isset($_SESSION['Utilisateur']) or  $_SESSION['Utilisateur']->getRole() !== 'admin') {
            $connect =  false;
        }
        return $connect;
    }

    public function add()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->remplerObject($this->vehicule, $_POST);
            $path = $this->vehicule->ajouterVehicule() ? "success" : "failed";
            header("Location: " . PATH_ROOT . "/dashboard/vehicules/add/$path");
            exit;
        }
    }

    public function delete()
    {
        if (isset($_POST['idVehicule'])) {
            $path = $this->vehicule->supprimerVehicule((int)$_POST['idVehicule']) ? "success" : "failed";
            header("Location: " . PATH_ROOT . "/dashboard/vehicules/delete/$path");
            exit;
        }
    }

    public function update()
    {
        if (isset($_POST['idVehicule'])) {
            $this->remplerObject($this->vehicule, $_POST);
            $path = $this->vehicule->modifierVehicule() ? "success" : "failed";
            header("Location: " . PATH_ROOT . "/dashboard/vehicules/update/$path");
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
