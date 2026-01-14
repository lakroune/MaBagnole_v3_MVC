<?php

namespace app\controller;

use app\model\Client;
use app\model\Reservation;
use app\model\Vehicule;

class ReservationsController
{
    private Client $client;
    private Reservation $reservation;
    private Vehicule $vehicule;
    private bool $connect;

    public function __construct()
    {
        $this->client = new Client();
        $this->reservation = new Reservation();
        $this->vehicule = new Vehicule();
        $this->connect = $this->isConnected();
    }
    public function default()
    {
        $this->index();
    }

    private function isConnected(): bool
    {
        $connect = true;
        if (!isset($_SESSION['Utilisateur']) or  $_SESSION['Utilisateur']->getRole() !== 'client') {
            $connect =  false;
        }
        return $connect;
    }
    public function index()
    {
        if (!$this->connect) {
            header('Location: ' . PATH_ROOT);
            exit();
        }
        $vehicule = $this->vehicule;
        $arrayReservations = $this->reservation->getResrvationByIdClient($_SESSION['Utilisateur']->getIdUtilisateur());
        require_once __DIR__ . '/../view/reservations.php';
    }
    public function add()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->remplerObject($this->reservation, $_POST);
            $path = $this->reservation->ajouterReservation() ? "success" : "failed";
            header("Location: " . PATH_ROOT . "/home/show/" . $this->reservation->getIdVehicule() . "/$path");
            exit;
        }
    }
    public function approve()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $path = $this->reservation->confirmerReservation($_POST['idReservation']) ? "success" : "failed";
            header("Location: " . PATH_ROOT . "/dashboard/reservations/$path");
            exit;
        }
    }
    public function annuler()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $path = $this->reservation->annulerReservation($_POST['idReservation']) ? "success" : "failed";
            header("Location: " . PATH_ROOT . "/dashboard/reservations/$path");
            exit;
        }
    }
    private function remplerObject($object, $data)
    {
        foreach ($data as $key => $value) {
            $method = 'set' . ucfirst($key);
            if (method_exists($object, $method)) {
                $object->$method($value);
                echo "<br>" . $method;
            }
        }
    }
}
