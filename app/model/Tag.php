<?php


namespace app\model;


use app\model\Connexion;


class Tag
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

    public function  ajouterTag(): bool
    {
        $db = Connexion::connect()->getConnexion();
        $sql = "INSERT INTO Tags (nomTag) VALUES (:nomTag)";
        try {
            $stmt = $db->prepare($sql);
        } catch (\Exception $e) {
            error_log(date('y-m-d h:i:s') . " Connexion :error ." . $e . PHP_EOL, 3, "error.log");
            return false;
        }
        $stmt->bindParam(":nomTag", $this->nomTag);
        if ($stmt->execute())
            return true;
        return false;
    }

    public function modifierTag(): bool
    {
        $db = Connexion::connect()->getConnexion();
        $sql = "update tags set nomTag=:nomTag where idTag=:idTag";
        try {
            $stmt = $db->prepare($sql);
        } catch (\Exception $e) {
            error_log(date('y-m-d h:i:s') . " Connexion :error ." . $e . PHP_EOL, 3, "error.log");
            return false;
        }
        $stmt->bindParam(":nomTag", $this->nomTag);
        $stmt->bindParam(":idTag", $this->idTag);
        if ($stmt->execute())
            return true;
        return false;
    }
    public function SupprimerTag(): bool
    {
        $db = Connexion::connect()->getConnexion();
        $sql = "delete from tags where idTag=:idTag";
        try {
            $stmt = $db->prepare($sql);
        } catch (\Exception $e) {
            error_log(date('y-m-d h:i:s') . " Connexion :error ." . $e . PHP_EOL, 3, "error.log");
            return false;
        }
        $stmt->bindParam(":idTag", $this->idTag);
        if ($stmt->execute())
            return true;
        return false;
    }

    public function getTag(int $idTag): ?Tag
    {
        $db = Connexion::connect()->getConnexion();
        $sql = "select * from tags  where idTag=:idTag";
        try {
            $stmt = $db->prepare($sql);
        } catch (\Exception $e) {
            error_log(date('y-m-d h:i:s') . " Connexion :error ." . $e . PHP_EOL, 3, "error.log");
            return null;
        }
        $stmt->execute();
        $stmt->bindParam(":idTag", $idTag);
        if ($stmt->execute())
            return $stmt->fetch(\PDO::FETCH_CLASS, Tag::class);
        return null;
    }
    static function getAllTag()
    {
        $db = Connexion::connect()->getConnexion();
        $sql = "select * from tags  ";
        try {
            $stmt = $db->prepare($sql);
        } catch (\Exception $e) {
            error_log(date('y-m-d h:i:s') . " Connexion :error ." . $e . PHP_EOL, 3, "error.log");
            return [];
        }
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_CLASS, Tag::class);
    }
    public function getTagsByArticle(int $idArticle): array
    {
        $db = Connexion::connect()->getConnexion();
        $sql = "SELECT t.* FROM Tags t
                JOIN ArticlesTags at ON t.idTag = at.idTag
                WHERE at.idArticle = :idArticle";
        try {
            $stmt = $db->prepare($sql);
        } catch (\Exception $e) {
            error_log(date('y-m-d h:i:s') . " Connexion :error ." . $e . PHP_EOL, 3, "error.log");
            return [];
        }
        $stmt->bindParam(":idArticle", $idArticle);
        if ($stmt->execute())
            return $stmt->fetchAll(\PDO::FETCH_CLASS, Tag::class);
        return [];
    }
}
