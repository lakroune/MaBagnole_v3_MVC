<?php

namespace app\controller;

use app\model\Categorie;

class CategoriesController
{
    private Categorie $categorie;
    function __construct()
    {
        if (!$this->isConnected()) {
            header('Location: ' . PATH_ROOT);
            exit();
        }
        $this->categorie = new Categorie();
    }

    public function index()
    {

        header('Location: ' . PATH_ROOT . '/dashboard/categories');
    }

    private function isConnected(): bool
    {
        $connect = true;
        if (!isset($_SESSION['Utilisateur']) or  $_SESSION['Utilisateur']->getRole() !== 'admin') {
            $connect =  false;
        }
        return $connect;
    }

    public function add()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->remplerObject($this->categorie, $_POST);
            $path = $this->categorie->ajouterCategorie() ? "success" : "failed";
            header("Location: " . PATH_ROOT . "/dashboard/categories/add/$path");
            exit;
        }
        $this->index();
    }

    public function delete()
    {
        if (isset($_POST['idCategorie'])) {
            $path = $this->categorie->supprimerCategorie((int)$_POST['idCategorie']) ? "success" : "failed";
            header("Location: " . PATH_ROOT . "/dashboard/categories/delete/$path");
            exit;
        }
        $this->index();
    }

    public function update()
    {
        if (isset($_POST['idCategorie'])) {
            $this->remplerObject($this->categorie, $_POST);
            $path = $this->categorie->modifierCategorie() ? "success" : "failed";
            header("Location: " . PATH_ROOT . "/dashboard/categories/update/$path");
            exit;
        }
        $this->index();
    }

    private function remplerObject($object, $data)
    {
        foreach ($data as $key => $value) {
            $method = 'set' . ucfirst($key);
            if (method_exists($object, $method)) {
                $object->$method($value);
            }
        }
    }
}
