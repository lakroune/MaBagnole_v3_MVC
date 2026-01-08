<?php



namespace app\controler;

require_once __DIR__ . '/../../vendor/autoload.php';

use app\model\Article;
use app\model\ArticleTags;
use app\model\Connexion;

if ($_SERVER['REQUEST_METHOD'] !== 'POST' || !isset($_POST['action']) || empty($_POST['action']) || ($_POST['action'] !== 'add' && $_POST['action'] !== 'delete')) {
    header("Location: ../view/");
    exit();
}

if ($_POST['action'] === 'add') {
    if (!empty($_POST['titreArticle']) && !empty($_POST['contenuArticle']) && !empty($_POST['idTheme'])) {

        $article = new Article();
        $article->setTitreArticle("dddd");
        $article->setContenuArticle("dddd");
        $article->setIdTheme(1);
        $article->setMedia("dddd");
        $article->setIdAuteur(1);
        $tags = isset($_POST['tags']) ? $_POST['tags'] : [];


        if ($article->ajouterArticle($tags)) {
            header("Location: ../view/themes.php?status=success");
            exit();
        } else {
            header("Location: ../view/themes.php?status=error");
            exit();
        }
    } else {
        header("Location: ../view/themes.php?status=invalid");
        exit();
    }
}
