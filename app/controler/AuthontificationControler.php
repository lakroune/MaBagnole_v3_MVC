<?php

namespace app\controler;

require_once __DIR__ . '/../../vendor/autoload.php';

use app\model\Utilisateur;


class AuthontificationControler
{
    private Utilisateur $utilisateur;

    public function __construct()
    {
        $this->utilisateur = new Utilisateur();
        $this->index();
    }

    public function  index()
    {
        $page = $_POST["page"] ?? "";
        switch ($page) {
            case "login":
                $isLogined = $this->seConnecter();
                if ($isLogined == "client") {
                    header("Location: accueil");
                } else if ($isLogined == "admin") {
                    header("Location: admin_dashboard");
                } else {
                    header("Location: login/failed");
                }
                break;
            default:
                header("Location: login");
                break;
        }
    }


    public function seConnecter()
    {
        $utilisateur = new Utilisateur();
        if (
            $utilisateur->setEmail($_POST["email"]) &&
            $utilisateur->setPassword($_POST["password"])
        )
            return   $utilisateur->seConnecter();
        else
            return false;
    }
}

$utilisateurControler = new AuthontificationControler();
