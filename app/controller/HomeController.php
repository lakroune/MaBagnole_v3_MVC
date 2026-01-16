<?php

namespace app\controller;

use app\model\Avis;
use app\model\Categorie;
use app\model\Client;
use app\model\Favori;
use app\model\Reservation;
use app\model\Vehicule;


class HomeController
{
    private Vehicule $vehicule;
    private Avis $avis;
    private Reservation $reservation;
    private Categorie $categorie;
    private Favori $favori;
    private Client $client;
    private bool $comment = false;
    private int  $reserver = 0;
    private bool $connect = false;
    public function __construct()
    {
        $this->vehicule = new Vehicule();
        $this->avis = new Avis();
        $this->reservation = new Reservation();
        $this->categorie = new Categorie();
        $this->client = new Client();
        $this->favori = new Favori();
        $this->connect = $this->isConnected();
    }
    private function isConnected(): bool
    {
        $connect = true;
        if (!isset($_SESSION['Utilisateur']) or  $_SESSION['Utilisateur']->getRole() !== 'client') {
            $connect =  false;
        }
        return $connect;
    }
    private function isReserver($idVehicule): int
    {
        if ($this->connect) {
            $idClient = $_SESSION['Utilisateur']->getIdUtilisateur();
            $this->reserver = $this->reservation->getReservationByClientVehicule($idClient, $idVehicule);
        }
        return $this->reserver;
    }
    private function isCommenter($idVehicule): bool
    {
        if (isset($_SESSION['Utilisateur']) && $_SESSION['Utilisateur']->getRole() === 'client') {
            $idClient = $_SESSION['Utilisateur']->getIdUtilisateur();
            $this->avis = new Avis();
            $this->comment = $this->avis->checkAvis($idClient, $idVehicule);
        }
        return $this->comment;
    }
    public function index()
    {
        $connect = $this->connect;
        $vehicules = $this->vehicule->getAllVehicules();
        $categories = $this->categorie->getAllCategories();
        $favori = $this->favori;
        require_once __DIR__ . '/../view/accueil.php';
    }
    public function show(int $idVehicule): void
    {
        $vehicule = $this->vehicule->getVehiculeById($idVehicule);
        $reviews = $this->avis->getAllAvisByVehicule($idVehicule);
        $client = $this->client;
        $connect = $this->connect;
        $isReserver = $this->isReserver($idVehicule);
        $dejaCommente = $this->isCommenter($idVehicule);
        require_once __DIR__ . '/../view/details.php';
    }
}
