<?php


namespace app\model;

use app\model\Connexion;


class Tag extends Connexion
{
    private int $idTag;
    private string $nomTag;
    public function __construct() {}

    //geter 

    public function getIdTag(): int
    {
        return $this->idTag;
    }

    public function getNomTag(): string
    {
        return $this->nomTag;
    }


    //seters

    public function setIdTag(int $idTag): void
    {
        if ($idTag < 1)
            throw new \InvalidArgumentException("ID tag invalide $idTag");
        else
            $this->idTag = $idTag;
    }

    public function setNomTag(string $nomTag): void
    {
        if (empty($nomTag))
            throw new \InvalidArgumentException("Nom tag invalide $nomTag");
        else
            $this->nomTag = $nomTag;
    }
    public function __toString(): string
    {
        return "idTag : $this->idTag, nomTag : $this->nomTag";
    }

    public function     ajouterTag(){
        try{
            
        }
    }
}
