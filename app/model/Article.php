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
}
