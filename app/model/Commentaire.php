<?php

namespace app\model;

use app\model\Connexion;
use Dom\Comment;
use PDO;

class Commentaire
{
    private  int $idCommentaire;
    private  int $idClient;
    private  int $idArticle;
    private  string $textCommentaire;
    private  string $dateCommentaire;

    public function __construct() {}


    // geter 
    public function getIdCommentaire(): int
    {
        return $this->idCommentaire;
    }

    public function getIdClient(): int
    {
        return $this->idClient;
    }

    public function getIdArticle(): int
    {
        return $this->idArticle;
    }

    public function getTextCommentaire(): string
    {
        return $this->textCommentaire;
    }

    public function getDateCommentaire(): string
    {
        return $this->dateCommentaire;
    }


    ///seter
    public function setIdCommentaire(int $idCommentaire): void
    {
        if ($idCommentaire < 1)
            throw new \InvalidArgumentException("ID commentaire invalide $idCommentaire");
        else
            $this->idCommentaire = $idCommentaire;
    }

    public function setIdClient(int $idClient): void
    {
        if ($idClient < 1)
            throw new \InvalidArgumentException("ID client invalide $idClient");
        else
            $this->idClient = $idClient;
    }

    public function setIdArticle(int $idArticle): void
    {
        if ($idArticle < 1)
            throw new \InvalidArgumentException("ID article invalide $idArticle");
        else
            $this->idArticle = $idArticle;
    }

    public function setTextCommentaire(string $textCommentaire): void
    {
        if (empty($textCommentaire))
            throw new \InvalidArgumentException("Text commentaire invalide $textCommentaire");
        else
            $this->textCommentaire = $textCommentaire;
    }

    public function setDateCommentaire(string $dateCommentaire): void
    {
        if (empty($dateCommentaire))
            throw new \InvalidArgumentException("Date commentaire invalide $dateCommentaire");
        else
            $this->dateCommentaire = $dateCommentaire;
    }

    // to string 
    public function __toString(): string
    {
        return "idCommentaire : $this->idCommentaire idClient : $this->idClient idArticle : $this->idArticle textCommentaire : $this->textCommentaire dateCommentaire : $this->dateCommentaire";
    }

    public function ajouterCommentaire(): bool
    {
        $db = Connexion::connect()->getConnexion();
        $sql = "INSERT INTO commentaires (idClient, idArticle, textCommentaire, dateCommentaire) VALUES (:idClient, :idArticle, :textCommentaire, :dateCommentaire)";
        try {
            $stmt = $db->prepare($sql);
        } catch (\Exception $e) {
            error_log(date('y-m-d h:i:s') . " Connexion :error ." . $e . PHP_EOL, 3, "error.log");
            return false;
        }
        $stmt->bindParam(":idClient", $this->idClient);
        $stmt->bindParam(":idArticle", $this->idArticle);
        $stmt->bindParam(":textCommentaire", $this->textCommentaire);
        $stmt->bindParam(":dateCommentaire", $this->dateCommentaire);
        if ($stmt->execute())
            return true;
        return false;
    }
    public function   modifierCommentaire(): bool
    {
        $db = Connexion::connect()->getConnexion();
        $sql = "update commentaires set textCommentaire=:textCommentaire where idCommentaire=:idCommentaire";
        try {
            $stmt = $db->prepare($sql);
        } catch (\Exception $e) {
            error_log(date('y-m-d h:i:s') . " Connexion :error ." . $e . PHP_EOL, 3, "error.log");
            return false;
        }
        $stmt->bindParam(":textCommentaire", $this->textCommentaire);
        $stmt->bindParam(":idCommentaire", $this->idCommentaire);
        if ($stmt->execute())
            return true;
        return false;
    }
    public function supprimerCommentaire(): bool
    {
        $db = Connexion::connect()->getConnexion();
        $sql = "update commentaires set deleteCommentaire=1 where idCommentaire=:idCommentaire";
        try {
            $stmt = $db->prepare($sql);
        } catch (\Exception $e) {
            error_log(date('y-m-d h:i:s') . " Connexion :error ." . $e . PHP_EOL, 3, "error.log");
            return false;
        }
        $stmt->bindParam(":idCommentaire", $this->idCommentaire);
        if ($stmt->execute())
            return true;
        return false;
    }
    public  function getIdCommentaireById(int $idCommentaire): ?object
    {
        $db = Connexion::connect()->getConnexion();
        $sql = "SELECT * FROM commentaires WHERE deleteCommentaire=0 and idCommentaire=:idCommentaire";
        try {
            $stmt = $db->prepare($sql);
        } catch (\Exception $e) {
            error_log(date('y-m-d h:i:s') . " Connexion :error ." . $e . PHP_EOL, 3, "error.log");
            return null;
        }
        $stmt->bindParam(":idCommentaire", $idCommentaire);
        $stmt->execute();
        if ($stmt->rowCount() > 0)
            return $stmt->fetchObject(Commentaire::class);
        return null;
    }
    public function getAllCommentaires(): array
    {
        $db = Connexion::connect()->getConnexion();
        $sql = "SELECT * FROM commentaires WHERE deleteCommentaire=0";
        try {
            $stmt = $db->prepare($sql);
        } catch (\Exception $e) {
            error_log(date('y-m-d h:i:s') . " function getAllCommentaires :error ." . $e . PHP_EOL, 3, "error.log");
            return [];
        }
        if ($stmt->execute())
            return $stmt->fetchAll(PDO::FETCH_CLASS, Commentaire::class);
        return [];
    }

    static  function getCommentairesByArticle(int $idArticle): array
    {
        $db = Connexion::connect()->getConnexion();
        $sql = "SELECT * FROM commentaires WHERE deleteCommentaire=0 and idArticle=:idArticle";
        try {
            $stmt = $db->prepare($sql);
        } catch (\Exception $e) {
            error_log(date('y-m-d h:i:s') . " function getCommentairesByArticle :error ." . $e . PHP_EOL, 3, "error.log");
            return [];
        }
        $stmt->bindParam(":idArticle", $idArticle);
        if ($stmt->execute())
            return $stmt->fetchAll(PDO::FETCH_CLASS, Commentaire::class);
        return [];
    }
}
