<?php



namespace app\controler;

use app\model\Avis;
use app\model\Client;

class Aviscontroller
{
    private Client $client;
    private Avis $avis;

    public function __construct()
    {
        $this->avis = new Avis();
        $this->client = new Client();
    }
    public function index()
    {
        echo "Avis";
    }


    public function register()
    {

        $this->remplerObject($this->avis, $_POST);
        $path =  $this->client->inscrire() ? "success" : "failed";
        header("Location: " . PATH_ROOT . "/Home/$path");
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
