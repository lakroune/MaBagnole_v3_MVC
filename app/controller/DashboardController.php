<?php


namespace app\controller;

use app\model\Avis;
use app\model\Categorie;
use app\model\Client;
use app\model\Reservation;
use app\model\Vehicule;

class DashboardController
{
    private Client $client;
    private Reservation $reservation;
    private Vehicule $vehicule;
    private Categorie $categorie;
    private Avis $avis;


    public function __construct()
    {
        $this->client = new Client();
        $this->reservation = new Reservation();
        $this->vehicule = new Vehicule();
        $this->categorie = new Categorie();
        $this->avis = new Avis();
    }


    public function index()
    {
        if (!$this->isConnected()) {
            header('Location: ' . PATH_ROOT);
            exit();
        }
        $statistiques = [
            'totalClients' => $this->client->counterClients(),
            'totalVehicules' => $this->vehicule->counterVehicules(),
            'totalCategories' => $this->categorie->counterCategorie(),
            'totalReservations' => $this->reservation->counterReservations(),
            'ClientsNouveaux' => $this->client->getNbClientsCreateToDay(),
            'RerservationsCreatesToday' => $this->reservation->getNbReservationToDay(),
            'RerservationsActive' => $this->reservation->getNbReservationActive(),
            'RerservationsConfirmer' => $this->reservation->getNbReservationConfirmer(),
            'RerservationsEnCours' => $this->reservation->getNbReservationEnCours(),
            'RerservationsAnnuler' => $this->reservation->getNbReservationAnnuler(),
            'RevenueReservation' => $this->reservation->getRevenueReservation(),
            'VehiculesDisponibles' => $this->vehicule->getNbVehiculeDisponible()
        ];
        require_once __DIR__ . '/../view/admin_dashboard.php';
    }
    public function default()
    {
        $this->index();
    }

    private function isConnected(): bool
    {
        $connect = true;
        if (!isset($_SESSION['Utilisateur']) or  $_SESSION['Utilisateur']->getRole() !== 'admin') {
            $connect =  false;
        }
        return $connect;
    }
    public function reservations()
    {
        if (!$this->isConnected()) {
            header('Location: ' . PATH_ROOT);
            exit();
        }
        $client = $this->client;
        $vehicule = $this->vehicule;
        $reservations = $this->reservation->getAllReservations();
        require_once __DIR__ . '/../view/admin_reservations.php';
    }

    public function vehicules()
    {
        if (!$this->isConnected()) {
            header('Location: ' . PATH_ROOT);
            exit();
        }
        $vehicules = $this->vehicule->getAllVehicules();
        require_once __DIR__ . '/../view/admin_fleet.php';
    }
    public function categories()
    {
        if (!$this->isConnected()) {
            header('Location: ' . PATH_ROOT);
            exit();
        }
        $categories = $this->categorie->getAllCategories();
        require_once __DIR__ . '/../view/admin_categories.php';
    }

    public function reviews()
    {
        if (!$this->isConnected()) {
            header('Location: ' . PATH_ROOT);
            exit();
        }
        $client = $this->client;
        $avis = $this->avis;
        $vehicule = $this->vehicule;
        $reservation = $this->reservation;
        $allReviews = $avis->getAllAvis();
        require_once __DIR__ . '/../view/admin_reviews.php';
    }
    public function clients()
    {
        if (!$this->isConnected()) {
            header('Location: ' . PATH_ROOT);
            exit();
        }
        $clients = $this->client->getAllClients();
        require_once __DIR__ . '/../view/admin_clients.php';
    }
}
