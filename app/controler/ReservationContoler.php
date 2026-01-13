<?php

namespace app\controler;

use app\model\Reservation;

require_once __DIR__ . '/../../vendor/autoload.php';


class ReservationContoler
{
    private Reservation $reservation;

    public function __construct()
    {
        session_start();
        $this->reservation = new Reservation();
        $this->index();
    }

    public function  index()
    {
        $action = $_POST["action"] ?? "";

        switch ($action) {
            case "rent":
                if ($this->ajouterReservation())
                    header("Location: accueil/id");
                else
                    header("Location: accueil/failed");
                break;
        }
    }





    public function ajouterReservation()
    {


        $this->reservation->setIdClient((int) $_SESSION['Utilisateur']->getIdUtilisateur());
        $this->reservation->setDateDebutReservation($_POST["dateDebutReservation"]);
        $this->reservation->setDateFinReservation($_POST["dateFinReservation"]);
        $this->reservation->setLieuChange($_POST["lieuChange"]);
        $this->reservation->setIdVehicule((int) $_POST["idVehicule"]);

        if ($this->reservation->ajouterReservation())
            return true;
        else
            return false;
    }
}



$clientControler = new ReservationContoler();
