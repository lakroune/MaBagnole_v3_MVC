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

    public function __construct()
    { if (!$this->isConnected('client')) {
            header('Location: ' . PATH_ROOT);
            exit();
        }

        $this->client = new Client();
        $this->reservation = new Reservation();
        $this->vehicule = new Vehicule();
    }
    public function default()
    {
        $this->index();
    }

    private function isConnected(string $role): bool
    {
        $connect = true;
        if (!isset($_SESSION['Utilisateur']) or  $_SESSION['Utilisateur']->getRole() !== $role) {
            $connect =  false;
        }
        return $connect;
    }
    public function index()
    {
        if (!$this->isConnected('client')) {
            header('Location: ' . PATH_ROOT);
            exit();
        } else {
            $vehicule = $this->vehicule;
            $arrayReservations = $this->reservation->getResrvationByIdClient($_SESSION['Utilisateur']->getIdUtilisateur());
            require_once __DIR__ . '/../view/reservations.php';
        }
    }
    public function add()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && $this->isConnected('client')) {
            $this->remplerObject($this->reservation, $_POST);
            $path = $this->reservation->ajouterReservation() ? "success" : "failed";
            header("Location: " . PATH_ROOT . "/home/show/" . $this->reservation->getIdVehicule() . "/$path");
            exit;
        }
    }
    public function status()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && $this->isConnected('admin')) {
            if (isset($_POST['action']) && $_POST['action'] == "confirmer") {
                $reslt =    $this->reservation->confirmerReservation($_POST['idReservation']) ? "success" : "failed";
            }
            if (isset($_POST['action']) && $_POST['action'] == "annuler") {
                $reslt =  $this->reservation->annulerReservation($_POST['idReservation']) ? "success" : "failed";
            }
            header("Location: " . PATH_ROOT . "/dashboard/reservations/status/$reslt");
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
