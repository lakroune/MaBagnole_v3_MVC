
<?php


namespace app\model;


use app\model\Connexion;

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
}
