<?php

namespace app\controler;

use app\model\Vehicule;

class VehiculeControler
{
    private Vehicule $vehicule;
    function __construct()
    {
        $this->vehicule = new Vehicule();
        $this->index();
    }
    public function index()
    {
        $action = $_POST["action"] ?? "";
        switch ($action) {
            case "add":
                if ($this->addVehicule())
                    header("Location: ../admin_fleet/add/success");
                else
                    header("Location: ../admin_fleet/add/failed");
                break;
            case "update":
                if ($this->updateVehicule())
                    header("Location: ../admin_fleet/update/success");
                else
                    header("Location: ../admin_fleet/update/failed");
                break;
            case "delete":
                if ($this->deleteVehicule())
                    header("Location: ../admin_fleet/delete/success");
                else
                    header("Location: ../admin_fleet/delete/failed");
                break;
            case "import":
                if ($this->importVehicules())
                    header("Location: ../admin_fleet/import/success");
                else
                    header("Location: ../admin_fleet/import/failed");
                break;
            default:
                header("Location: ../admin_fleet");
                break;
        }
    }



    private function addVehicule()
    {
        $this->vehicule->setMarqueVehicule($_POST["marqueVehicule"]);
        $this->vehicule->setModeleVehicule($_POST["modeleVehicule"]);
        $this->vehicule->setAnneeVehicule($_POST["anneeVehicule"]);
        $this->vehicule->setCouleurVehicule($_POST["couleurVehicule"]);
        $this->vehicule->setPrixVehicule($_POST["prixVehicule"]);
        $this->vehicule->setTypeBoiteVehicule($_POST["typeBoiteVehicule"]);
        $this->vehicule->setTypeCarburantVehicule($_POST["typeCarburantVehicule"]);
        $this->vehicule->setImageVehicule($_POST["imageVehicule"] ?? "iamege");  // mtnssach tzid image   edit
        $this->vehicule->setIdCategorie((int)$_POST["idCategorie"]);
        if ($this->vehicule->ajouterVehicule())
            return true;
        return false;
    }
    private function updateVehicule()
    {
        $this->vehicule->setIdVehicule($_POST['idVehicule']);
        $this->vehicule->setMarqueVehicule($_POST["marqueVehicule"]);
        $this->vehicule->setModeleVehicule($_POST["modeleVehicule"]);
        $this->vehicule->setAnneeVehicule($_POST["anneeVehicule"]);
        $this->vehicule->setCouleurVehicule($_POST["couleurVehicule"]);
        $this->vehicule->setPrixVehicule($_POST["prixVehicule"]);
        $this->vehicule->setTypeBoiteVehicule($_POST["typeBoiteVehicule"]);
        $this->vehicule->setTypeCarburantVehicule($_POST["typeCarburantVehicule"]);
        $this->vehicule->setImageVehicule($_POST["imageVehicule"] ?? "iamege");  // mtnssach tzid image   edit
        $this->vehicule->setIdCategorie((int)$_POST["idCategorie"]);
        if ($this->vehicule->modifierVehicule())
            return true;
        return false;
    }
    private function deleteVehicule()
    {
        $idVehicule = (int) ($_POST['idVehicule']);
        if ($this->vehicule->supprimerVehicule($idVehicule))
            return true;
        return false;
    }
    private function importVehicules()
    {

        if (isset($_POST["action"]) && $_POST["action"] == "import") {
            $bulkData = $_POST['bulkData'] ?? '';

            if (!empty($bulkData)) {
                $lines = explode("\n", str_replace("\r", "", $bulkData));
                $successCount = 0;

                foreach ($lines as $line) {
                    if (empty(trim($line))) continue;
                    $data = explode(",", $line);
                    if (count($data) >= 7) {
                        $v = new Vehicule();
                        $v->setMarqueVehicule(trim($data[0]));
                        $v->setModeleVehicule(trim($data[1]));
                        $v->setAnneeVehicule(trim($data[2]));
                        $v->setCouleurVehicule(trim($data[3]));
                        $v->setTypeBoiteVehicule(trim($data[4]));
                        $v->setTypeCarburantVehicule(trim($data[5]));
                        $v->setPrixVehicule(trim($data[6]));
                        $v->setIdCategorie(trim($data[7] ?? 1));
                        $v->setImageVehicule(trim($data[8] ?? 'image'));
                        if ($v->ajouterVehicule()) {
                            $successCount++;
                        }
                    }
                }
                if ($successCount > 0) {
                    return "success";
                } else {
                    return "failed";
                }
            }
        }
    }
}

$adminControler = new VehiculeControler();
