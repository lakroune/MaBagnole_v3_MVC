<?php

namespace app\controler;

use app\model\Avis;

class AvisController
{
    private Avis $avis;
    public function __construct()
    {
        $this->avis = new Avis();
        $this->index();
    }

    private function  index()
    {
        $action = $_POST["action"] ?? "";

        switch ($action) {
            case "addReview":
                if ($this->addAvis())
                    header("Location: ../view/details.php?" . $_POST['action'] . "=success&id=" . $_POST['idVehicule']);
                else
                    header("Location: ../view/details.php?" . $_POST['action'] . "=failed&id=" . $_POST['idVehicule']);
                break;
            case "deleteReview":
                if ($this->deleteAvis())
                    header("Location: ../view/details.php?" . $_POST['action'] . "=success&id=" . $_POST['idVehicule']);
                else
                    header("Location: ../view/details.php?" . $_POST['action'] . "=failed&id=" . $_POST['idVehicule']);
                break;
            case "updateReview":
                if ($this->updateAvis())
                    header("Location: ../view/details.php?" . $_POST['action'] . "=success&id=" . $_POST['idVehicule']);
                else
                    header("Location: ../view/details.php?" . $_POST['action'] . "=failed&id=" . $_POST['idVehicule']);
                break;
        }
    }







    private function addAvis()
    {
        $avis = new Avis();
        session_start();
        $avis->setCommentaireAvis($_POST["textReview"]);
        $avis->setNoteAvis((int)$_POST["ratings"]);
        $avis->setIdClient($_SESSION['Utilisateur']->getIdUtilisateur());
        $avis->setIdReservation((int)$_POST["idReservation"]);

        if ($avis->ajouterAvis())
            return true;
        else
            return false;
    }
    private function deleteAvis()
    {
        $avis = new Avis();
        $avis->setIdAvis((int)$_POST["idAvis"]);
        if ($avis->rejectReview($avis->getIdAvis()))
            return true;
        else
            return false;
    }
    private function updateAvis()
    {

        $avis = new Avis();
        $avis->setIdAvis((int)$_POST["idAvis"]);
        $avis->setCommentaireAvis($_POST["textReview"]);
        if ($avis->modifierAvis($avis->getIdAvis()))
            return true;
        else
            return false;
    }
}



