<?php

namespace app\model;

use Exception;

class ArticleTags
{
    private int $idArticle;
    private int $idTag;

    static function ajouterTageToArticle(int  $idArticle, int $idTag): bool
    {
        try {
            $db = Connexion::connect()->getConnexion();
            $query = "INSERT INTO ArticlesTags (idArticle, idTag)
                      VALUES (:idArticle, :idTag)";
            $stmt = $db->prepare($query);
            $stmt->bindValue(':idArticle', $idArticle);
            $stmt->bindValue(':idTag', $idTag);
            if ($stmt->execute())
                return true;
            else
                return false;
        } catch (Exception $e) {
            return false;
        }
    }
}
