<?php

namespace app\controler;

use app\model\Commentaire;


if ($_SERVER['REQUEST_METHOD'] !== 'POST' || !isset($_POST['action']) || empty($_POST['action']) || ($_POST['action'] !== 'add' && $_POST['action'] !== 'edit' && $_POST['action'] !== 'delete')) {
    header("Location: ../view/article_detail.php");
    exit();
}

if ($_POST['action'] === 'add' && isset($_POST['commentaire'])) {
    $commentaire = new Commentaire();
    $commentaire->setIdArticle((int)$_POST['idArticle']);
    $commentaire->setTextCommentaire($_POST['commentaire']);
    if ($commentaire->ajouterCommentaire()) {
        header("Location: ../view/article_detail.php?id=" . $_POST['idArticle'] . "&commentaire=success");
        exit();
    } else {
        header("Location: ../view/article_detail.php?id=" . $_POST['idArticle'] . "&commentaire=error");
        exit();
    }
}

if ($_POST['action'] === 'delete' && isset($_POST['idCommentaire'])) {
    $commentaire = new Commentaire();
    $commentaire->setIdCommentaire((int)$_POST['idCommentaire']);
    if ($commentaire->supprimerCommentaire()) {
        header("Location: ../view/article_detail.php?id=" . $_POST['idArticle'] . "&commentaire=success");
        exit();
    } else {
        header("Location: ../view/article_detail.php?id=" . $_POST['idArticle'] . "&commentaire=error");
        exit();
    }
}

if ($_POST['action'] === 'edit' && isset($_POST['idCommentaire']) && isset($_POST['commentaire'])) {
    $commentaire = new Commentaire();
    $commentaire->setIdCommentaire((int)$_POST['idCommentaire']);
    $commentaire->setTextCommentaire($_POST['commentaire']);
    if ($commentaire->modifierCommentaire()) {
        header("Location: ../view/article_detail.php?id=" . $_POST['idArticle'] . "&commentaire=success");
        exit();
    } else {
        header("Location: ../view/article_detail.php?id=" . $_POST['idArticle'] . "&commentaire=error");
        exit();
    }
}
