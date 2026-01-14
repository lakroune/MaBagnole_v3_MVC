<?php

namespace app\controller;

use app\model\Vehicule;

class HomeController
{
    private Vehicule $vehicule;

    public function __construct()
    {
        $this->vehicule = new Vehicule();
    }

    public function index()
    {
        $vehicules = $this->vehicule->getAllVehicules();
        require_once __DIR__ . '/../view/accueil.php';
    }
}
