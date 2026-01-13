<?php

namespace app\controler;

use app\model\Client;

class RegisterControler
{
    private Client $client;

    public function __construct()
    {
        $this->client = new Client();
        $this->index();
    }

    public function  index()
    {
        $page = $_POST["page"] ?? "";

        switch ($page) {
            case "register":
                if ($this->inscrire()) {
                    header("Location: register/success");
                } else {
                    header("Location: register/failed");
                }
                break;

            default:
                header("Location: accueil");
                break;
        }
    }


    public function inscrire()
    {
        if (
            $this->client->setNomUtilisateur($_POST['nomUtilisateur']) &&
            $this->client->setPrenomUtilisateur($_POST['prenomUtilisateur']) &&
            $this->client->setTelephone($_POST['telephone']) &&
            $this->client->setVille($_POST['ville']) &&
            $this->client->setEmail($_POST['email']) &&
            $this->client->setRole('client') &&
            $this->client->setPassword($_POST['paword']) &&
            $this->client->inscrire()
        )
            return true;
        else
            return false;
    }
}

$register = new RegisterControler();
