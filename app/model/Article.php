<?php

namespace app\model;

use app\model\Connexion;
use app\model\Tag;

class Article
{

    private int $idArticle;
    private string $titreArticle;
    private string $contenuArticle;
    private array $medias;
    private int $statutArticle;
    private Tag $tag;
    private string $dateCreationArticle;
    private int $idTheme;
    private int $idAuteur;

    public function construct() {}
    //geter 
    public function getIdArticle(): int
    {
        return $this->idArticle;
    }

    public function getTitreArticle(): string
    {
        return $this->titreArticle;
    }

    public function getContenuArticle(): string
    {
        return $this->contenuArticle;
    }

    public function getMedias(): array
    {
        return $this->medias;
    }

    public function getStatutArticle(): int
    {
        return $this->statutArticle;
    }

    public function getDateCreationArticle(): string
    {
        return $this->dateCreationArticle;
    }

    public function getIdTheme(): int
    {
        return $this->idTheme;
    }

    public function getIdAuteur(): int
    {
        return $this->idAuteur;
    }

    public function setIdArticle(int $idArticle)
    {
        if ($idArticle < 1)
            throw new \InvalidArgumentException("ID article invalide : $idArticle");
        else
            $this->idArticle = $idArticle;
    }

    public function setTitreArticle(string $titreArticle)
    {
        if (empty($titreArticle))
            throw new \InvalidArgumentException("Titre article invalide : $titreArticle");
        else
            $this->titreArticle = $titreArticle;
    }
    public function setContenuArticle(string $contenuArticle)
    {
        if (empty($contenuArticle))
            throw new \InvalidArgumentException("Contenu article invalide : $contenuArticle");
        else
            $this->contenuArticle = $contenuArticle;
    }

    public function setStatutArticle(int $statutArticle)
    {
        if (empty($statutArticle))
            throw new \InvalidArgumentException("Statut article invalide : $statutArticle");
        else
            $this->statutArticle = $statutArticle;
    }
    public function setDateCreationArticle(string $dateCreationArticle)
    {
        if (empty($dateCreationArticle))
            throw new \InvalidArgumentException("Date article invalide : $dateCreationArticle");
        else
            $this->dateCreationArticle = $dateCreationArticle;
    }
    public function setIdTheme(int $idTheme)
    {
        if ($idTheme < 1)
            throw new \InvalidArgumentException("ID theme invalide : $idTheme");
        else
            $this->idTheme = $idTheme;
    }
    public function setIdAuteur(int $idAuteur)
    {
        if ($idAuteur < 1)
            throw new \InvalidArgumentException("ID auteur invalide : $idAuteur");
        else
            $this->idAuteur = $idAuteur;
    }


    //to String 

    public function __toString(): string
    {
        return "idArticle :$this->idArticle, titreArticle :$this->titreArticle, contenuArticle :$this->contenuArticle, dateCreationArticle :$this->dateCreationArticle, idTheme :$this->idTheme, idAuteur :$this->idAuteur";
    }

    public  function AjouterArticle(): bool
    {
        try {
            $db = Connexion::connect()->getConnexion();
            $query = "INSERT INTO article (titreArticle, contenuArticle, statutArticle, dateCreationArticle, idTheme, idAuteur) 
                      VALUES (:titreArticle, :contenuArticle, :statutArticle, :dateCreationArticle, :idTheme, :idAuteur)";
            $stmt = $db->prepare($query);
            $stmt->bindValue(':titreArticle', $this->titreArticle);
            $stmt->bindValue(':contenuArticle', $this->contenuArticle);
            $stmt->bindValue(':statutArticle', $this->statutArticle);
            $stmt->bindValue(':dateCreationArticle', $this->dateCreationArticle);
            $stmt->bindValue(':idTheme', $this->idTheme);
            $stmt->bindValue(':idAuteur', $this->idAuteur);
            return $stmt->execute();
        } catch (\Exception $e) {
            throw new \Exception("Erreur lors de l'ajout de l'article : " . $e->getMessage());
        }
    }

    static function getAllArticles(): array
    {
        try {
            $db = Connexion::connect()->getConnexion();
            $sql = "SELECT * FROM articles";
            $stmt = $db->prepare($sql);
            $stmt->execute();
            return  $stmt->fetchAll(\PDO::FETCH_CLASS, Article::class);
        } catch (\Exception $e) {
            return [];
        }
    }

    public function getArticleById(int $idArticle): ?Article
    {
        try {
            $db = Connexion::connect()->getConnexion();
            $sql = "SELECT * FROM articles WHERE idArticle = :idArticle";
            $stmt = $db->prepare($sql);
            $stmt->bindParam(":idArticle", $idArticle);
            $stmt->execute();
            $stmt->setFetchMode(\PDO::FETCH_CLASS, Article::class);
            $article = $stmt->fetch();
            return $article ?: null;
        } catch (\Exception $e) {
            return null;
        }
    }
    public function supprimerArticle($idArticle): bool
    {
        try {
            $db = Connexion::connect()->getConnexion();
            $sql = "DELETE FROM articles WHERE idArticle = :idArticle";
            $stmt = $db->prepare($sql);
            $stmt->bindParam(":idArticle", $idArticle);
            return $stmt->execute();
        } catch (\Exception $e) {
            return false;
        }
    }

    static function nbArticlesByTheme(int $idTheme): int
    {
        try {
            $db = Connexion::connect()->getConnexion();
            $sql = "SELECT COUNT(*) as nbArticles FROM articles WHERE idTheme = :idTheme";
            $stmt = $db->prepare($sql);
            $stmt->bindParam(":idTheme", $idTheme);
            $stmt->execute();
            $result = $stmt->fetch(\PDO::FETCH_ASSOC);
            return (int)$result['nbArticles'] ?? 0;
        } catch (\Exception $e) {
            return 0;
        }
    }
    static function getArticlesByTheme(int $idTheme): array
    {
        try {
            $db = Connexion::connect()->getConnexion();
            $sql = "SELECT * FROM articles WHERE idTheme = :idTheme";
            $stmt = $db->prepare($sql);
            $stmt->bindParam(":idTheme", $idTheme);
            $stmt->execute();
            return $stmt->fetchAll(\PDO::FETCH_CLASS, Article::class);
        } catch (\Exception $e) {
            return [];
        }
    }
    public function rechercherArticlesParTitre(string $searchTerm, int $idTheme): array
    {
        try {
            $db = Connexion::connect()->getConnexion();
            $sql = "SELECT * FROM articles WHERE idTheme= :idTheme and titreArticle LIKE :searchTerm";
            $stmt = $db->prepare($sql);
            $likeTerm = "%" . $searchTerm . "%";
            $stmt->bindParam(":searchTerm", $likeTerm);
            $stmt->bindParam(":idTheme", $idTheme);
            $stmt->execute();
            return $stmt->fetchAll(\PDO::FETCH_CLASS, Article::class);
        } catch (\Exception $e) {
            return [];
        }
    }
}
