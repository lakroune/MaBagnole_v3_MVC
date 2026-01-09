<?php

namespace app\model;

use app\model\Connexion;
use app\model\Tag;
use Exception;

class Article
{
    private int $idArticle;
    private string $titreArticle;
    private string $contenuArticle;
    private string $media;
    private int $statutArticle;
    private Tag $tag;
    private string $datePublicationArticle;
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

    public function getMedia(): string
    {
        return $this->media;
    }

    public function getStatutArticle(): int
    {
        return $this->statutArticle;
    }

    public function getDatePublicationArticle(): string
    {
        return $this->datePublicationArticle;
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
    public function setMedia(string $media)
    {
        if (empty($media))
            throw new \InvalidArgumentException("Media article invalide : $media");
        else
            $this->media = $media;
    }

    public function setStatutArticle(int $statutArticle)
    {
        if (empty($statutArticle))
            throw new \InvalidArgumentException("Statut article invalide : $statutArticle");
        else
            $this->statutArticle = $statutArticle;
    }
    public function setDatePublicationArticle(string $datePublicationArticle)
    {
        if (empty($datePublicationArticle))
            throw new \InvalidArgumentException("Date article invalide : $datePublicationArticle");
        else
            $this->datePublicationArticle = $datePublicationArticle;
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
        return "idArticle :$this->idArticle, titreArticle :$this->titreArticle, contenuArticle :$this->contenuArticle, datePublicationArticle :$this->datePublicationArticle, idTheme :$this->idTheme, idAuteur :$this->idAuteur";
    }

    public  function AjouterArticle(array $tags): bool
    {
        try {
            $db = Connexion::connect()->getConnexion();
            $db->beginTransaction();
            $query = "INSERT INTO articles (titreArticle, contenuArticle,statutArticle, idTheme, idAuteur)
                      VALUES (:titreArticle, :contenuArticle,  :statutArticle,:idTheme, :idAuteur)";
            $stmt = $db->prepare($query);
            $stmt->bindValue(':titreArticle', $this->titreArticle);
            $stmt->bindValue(':contenuArticle', $this->contenuArticle);
            $stmt->bindValue(':idTheme', $this->idTheme);
            $stmt->bindValue(':statutArticle', 0);
            $stmt->bindValue(':idAuteur', $this->idAuteur);
            if ($stmt->execute()) {
                $lastId = $db->lastInsertId();

                if (!empty($tags)) {
                    $sqlTag =  "INSERT INTO ArticlesTags (idArticle, idTag)VALUES (:idArticle, :idTag)";
                    $stmtTag = $db->prepare($sqlTag);
                    foreach ($tags as $idTag) {

                        $stmtTag = $db->prepare($sqlTag);
                        $stmtTag->bindValue(':idArticle', $lastId);
                        $stmtTag->bindValue(':idTag', $idTag);
                        $stmtTag->execute();
                    }
                }
                $db->commit();
                return true;
            } else
                return false;
            return false;
        } catch (Exception $e) {
            $db->rollBack();
            throw new Exception("Erreur lors de l'ajout de l'article : " . $e);
            return false;
        }
    }

    static function getAllArticles(): array
    {
        try {
            $db = Connexion::connect()->getConnexion();
            $sql = "SELECT * FROM articles WHERE deleteArticle = 0  ORDER BY datePublicationArticle DESC";
            $stmt = $db->prepare($sql);
            $stmt->execute();
            return  $stmt->fetchAll(\PDO::FETCH_CLASS, Article::class);
        } catch (\Exception $e) {
            return [];
        }
    }
    static function getAllArticlesNonApprouve(): array
    {
        try {
            $db = Connexion::connect()->getConnexion();
            $sql = "SELECT * FROM articles WHERE deleteArticle = 0 and statutArticle = 0  ORDER BY datePublicationArticle DESC";
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
            $sql = "SELECT * FROM articles WHERE deleteArticle = 0 AND idArticle = :idArticle";
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
    public function supprimerArticle(int $idArticle): bool
    {
        try {
            $db = Connexion::connect()->getConnexion();
            $sql = "update articles set deleteArticle = 1 WHERE idArticle = :idArticle";
            $stmt = $db->prepare($sql);
            $stmt->bindParam(":idArticle", $idArticle);
            return $stmt->execute();
        } catch (\Exception $e) {
            return false;
        }
    }
    public function validerArticle(int $idArticle): bool
    {
        try {
            $db = Connexion::connect()->getConnexion();
            $sql = "update articles set statutArticle = 1 WHERE idArticle = :idArticle";
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
            $sql = "SELECT COUNT(*) as nbArticles FROM articles WHERE deleteArticle = 0 and statutArticle = 1 and  idTheme = :idTheme";
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
            $sql = "SELECT * FROM articles WHERE idTheme = :idTheme and statutArticle = 1 and deleteArticle = 0 ORDER BY idArticle DESC";
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
            $sql = "SELECT * FROM articles WHERE idTheme= :idTheme and statutArticle = 1  and deleteArticle = 0  and titreArticle LIKE :searchTerm ORDER BY idArticle DESC";
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
    public function feltrerArticlesParTag(int $idTag, int $idTheme): array
    {
        try {
            $db = Connexion::connect()->getConnexion();
            $sql = "SELECT a.* FROM articles a
                    JOIN ArticlesTags at ON a.idArticle = at.idArticle
                    WHERE at.idTag = :idTag AND a.idTheme = :idTheme AND a.statutArticle = 1 AND a.deleteArticle = 0
                    ORDER BY a.idArticle DESC";
            $stmt = $db->prepare($sql);
            $stmt->bindParam(":idTag", $idTag);
            $stmt->bindParam(":idTheme", $idTheme);
            $stmt->execute();
            return $stmt->fetchAll(\PDO::FETCH_CLASS, Article::class);
        } catch (\Exception $e) {
            return [];
        }
    }
}
