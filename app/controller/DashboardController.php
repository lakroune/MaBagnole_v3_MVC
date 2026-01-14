<?php


namespace app\controller;

use app\model\Categorie;
use app\model\Client;
use app\model\Reservation;
use app\model\Vehicule;

class DashboardController
{
    private $connect = false;
    private Client $client;
    private Reservation $reservation;
    private Vehicule $vehicule;
    private Categorie $categorie;


    public function __construct()
    {
        $this->client = new Client();
        $this->reservation = new Reservation();
        $this->vehicule = new Vehicule();
        $this->categorie = new Categorie();
        $this->connect = $this->isConnected();
    }


    public function index()
    {
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

    private function isConnected(): bool
    {
        $connect = true;
        if (!isset($_SESSION['Utilisateur']) or  $_SESSION['Utilisateur']->getRole() !== 'admin') {
            $connect =  false;
        }
        return $connect;
    }
}
