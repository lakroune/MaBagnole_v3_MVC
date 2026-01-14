<?php

namespace app\controller;

use app\model\Vehicule;

class VehiculeController
{
    private Vehicule $vehicule;

    public function __construct()
    {
        $this->vehicule = new Vehicule();
    }

    public function add()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->remplerObject($this->vehicule, $_POST);
            $path = $this->vehicule->ajouterVehicule() ? "success" : "failed";
            header("Location: /admin_fleet/add/$path");
            exit;
        }
    }

    public function delete()
    {
        if (isset($_POST['idVehicule'])) {
            $path = $this->vehicule->supprimerVehicule((int)$_POST['idVehicule']) ? "success" : "failed";
            header("Location: /admin_fleet/delete/$path");
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
