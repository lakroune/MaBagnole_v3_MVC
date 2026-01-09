<?php

namespace app\model;

use app\model\Connexion;
use Exception;
use InvalidArgumentException;

class AimerArticle
{

    private int $idClient;
    private int $idArticle;


    public function __construct() {}

    //geter
    public function getIdClient(): int
    {
        return $this->idClient;
    }
    public function getIdArticle(): int
    {
        return $this->idArticle;
    }

    //seters

    public function setIdClient(int $idClient): void
    {
        if ($idClient < 1)
            throw new InvalidArgumentException("ID client invalide $idClient");
        else
            $this->idClient = $idClient;
    }
    public function setIdArticle(int $idArticle): void
    {
        if ($idArticle < 1)
            throw new InvalidArgumentException("ID article invalide $idArticle");
        else
            $this->idArticle = $idArticle;
    }


    //toString

    public function __toString(): string
    {
        return "idClient : $this->idClient, idArticle : $this->idArticle";
    }

    public function aimerArticle(): bool
    {
        $db = Connexion::connect()->getConnexion();
        $sql = "call aimerArticle   (:idClient, :idArticle)";
        try {
            $stmt = $db->prepare($sql);
        } catch (Exception $e) {
            throw new Exception("il y a une erreur quand on aimer un article ." . $e);
            return false;
        }
        $stmt->bindParam(":idClient", $this->idClient);
        $stmt->bindParam(":idArticle", $this->idArticle);
        if ($stmt->execute())
            return true;
        return false;
    }
    // public function annulerAimerArticle(): bool
    // {
    //     $db = Connexion::connect()->getConnexion();
    //     $sql = "DELETE FROM aimerarticle WHERE idClient=:idClient and idArticle=:idArticle";
    //     try {
    //         $stmt = $db->prepare($sql);
    //     } catch (Exception $e) {
    //         error_log(date('y-m-d h:i:s') . " Connexion :error ." . $e . PHP_EOL, 3, "error.log");
    //         return false;
    //     }
    //     $stmt->bindParam(":idClient", $this->idClient);
    //     $stmt->bindParam(":idArticle", $this->idArticle);
    //     if ($stmt->execute())
    //         return true;
    //     return false;
    // }

    public function isAimerArticle(int $idClient, int $idArticle): bool
    {
        $db = Connexion::connect()->getConnexion();
        $sql = "SELECT * FROM aimerarticle WHERE idClient=:idClient and idArticle=:idArticle";
        try {
            $stmt = $db->prepare($sql);
        } catch (Exception $e) {
            error_log(date('y-m-d h:i:s') . " Connexion :error ." . $e . PHP_EOL, 3, "error.log");
            return false;
        }
        $stmt->bindParam(":idClient", $idClient);
        $stmt->bindParam(":idArticle", $idArticle);
        $stmt->execute();
        if ($stmt->rowCount() > 0)
            return true;
        return false;
    }
}
