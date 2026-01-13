<?php

namespace app\controler;

use app\model\Categorie;

class CategorieContoler
{
    private Categorie $categorie;
    function __construct()
    {
        $this->categorie = new Categorie();
        $this->index();
    }
    public function index()
    {
        $action = $_POST["action"] ?? "";
        switch ($action) {

            case "delete":
                $this->categorie->setIdCategorie((int)$_POST["idCategorie"]); // $_POST["idCategorie"];
                if ($this->categorie->supprimerCategorie($this->categorie->getIdCategorie()))
                    header("Location: ../admin_categories/delete/success");
                else
                    header("Location: ../admin_categories/delete/failed");
                break;
            case "update":
                $this->categorie->setIdCategorie((int)$_POST["idCategorie"]); // $_POST["idCategorie"];
                $this->categorie->setTitreCategorie($_POST["nomCategorie"] ?? "");
                $this->categorie->setDescriptionCategorie($_POST["descriptionCategorie"] ?? "");
                if ($this->categorie->modifierCategorie())
                    header("Location: ../admin_categories/update/success");
                else
                    header("Location: ../admin_categories/update/failed");
                break;
            case "add":
                $categorie = new Categorie();
                $categorie->setTitreCategorie($_POST["nomCategorie"] ?? "");
                $categorie->setDescriptionCategorie($_POST["descriptionCategorie"] ?? "");
                if ($categorie->ajouterCategorie())

                    header("Location: ../admin_categories/add/success");
                else
                    header("Location: ../admin_categories/add/failed");
                break;


            default:
                header("Location: ../admin_categories");
                break;
        }
    }
}

$adminControler = new AdminControler();
