<?php


namespace app\model;

use app\model\Connexion;


class Theme
{
    private $idTheme;
    private $nomTheme;
    private $descriptionTheme;

    public function __construct() {}
    
    public function getIdTheme(): int
    {
        return $this->idTheme;
    }
    public function getNomTheme(): string
    {
        return $this->nomTheme;
    }
    public function getDescriptionTheme(): string
    {
        return $this->descriptionTheme;
    }
    
    public function setIdTheme(int $idTheme): void
    {
        if ($idTheme < 1)
            throw new \InvalidArgumentException("ID theme invalide $idTheme");
        else
            $this->idTheme = $idTheme;
    }
    public function setNomTheme(string $nomTheme): void
    {
        if (empty($nomTheme))
            throw new \InvalidArgumentException("Nom theme invalide $nomTheme");
        else
            $this->nomTheme = $nomTheme;
    }
    public function setDescriptionTheme(string $descriptionTheme): void
    {
        if (empty($descriptionTheme))
            throw new \InvalidArgumentException("Description theme invalide $descriptionTheme");
        else
            $this->descriptionTheme = $descriptionTheme;
    }

    
    public function __toString(): string
    {
        return "idTheme :$this->idTheme, nomTheme :$this->nomTheme, descriptionTheme :$this->descriptionTheme";
    }


    public function  ajouterTheme(): bool
    {
        try {
            $db = Connexion::connect()->getConnexion();
            $sql = "insert into themes (nomTheme, descriptionTheme) values (:nomTheme, :descriptionTheme)";
            $stmt = $db->prepare($sql);
            $stmt->bindParam(":nomTheme", $this->nomTheme);
            $stmt->bindParam(":descriptionTheme", $this->descriptionTheme);
            if ($stmt->execute())
                return true;
            else
                return false;
        } catch (\Exception $e) {
            error_log(date('y-m-d h:i:s') . " Connexion :error ." . $e . PHP_EOL, 3, "error.log");
            return false;
        }
    }



    public function  modifierTheme(): bool
    {
        try {
            $db = Connexion::connect()->getConnexion();
            $sql = "update themes set nomTheme=:nomTheme, descriptionTheme=:descriptionTheme where idTheme=:idTheme";
            $stmt = $db->prepare($sql);
            $stmt->bindParam(":nomTheme", $this->nomTheme);
            $stmt->bindParam(":descriptionTheme", $this->descriptionTheme);
            $stmt->bindParam(":idTheme", $this->idTheme);
            if ($stmt->execute())
                return true;
            else
                return false;
        } catch (\Exception $e) {
            error_log(date('y-m-d h:i:s') . " Connexion :error ." . $e . PHP_EOL, 3, "error.log");
            return false;
        }
    }
    public function supprimerTheme()
    {
        try {
            $db = Connexion::connect()->getConnexion();
            $sql = "delete from themes where idTheme=:idTheme";
            $stmt = $db->prepare($sql);
            $stmt->bindParam(":idTheme", $this->idTheme);
            if ($stmt->execute())
                return true;
            else
                return false;
        } catch (\Exception $e) {
            error_log(date('y-m-d h:i:s') . " Connexion :error ." . $e . PHP_EOL, 3, "error.log");
            return false;
        }
    }

    public function getThemeById( int $idTheme): ?Theme
    {
        try {
            $db = Connexion::connect()->getConnexion();
            $sql = "select * from themes where idTheme=:idTheme";
            $stmt = $db->prepare($sql);
            $stmt->bindParam(":idTheme", $idTheme);
            if ($stmt->execute())
                return $stmt->fetchObject(Theme::class);
            else
                return null;
        } catch (\Exception $e) {
            error_log(date('y-m-d h:i:s') . " Connexion :error ." . $e . PHP_EOL, 3, "error.log");
            return null;
        }
    }

    static function getAllTheme(): array
    {
        try {
            $db = Connexion::connect()->getConnexion();
            $sql = "select * from themes";
            $stmt = $db->prepare($sql);
            if ($stmt->execute())
                return $stmt->fetchAll(\PDO::FETCH_CLASS, Theme::class);
            else
                return [];
        } catch (\Exception $e) {
            error_log(date('y-m-d h:i:s') . " Connexion :error ." . $e . PHP_EOL, 3, "error.log");
            return [];
        }
    }
}
