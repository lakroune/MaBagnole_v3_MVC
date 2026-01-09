<?php



namespace app\controler;

require_once __DIR__ . '/../../vendor/autoload.php';

use app\model\Article;
use app\model\ArticleTags;
use app\model\Connexion;

if ($_SERVER['REQUEST_METHOD'] !== 'POST' || !isset($_POST['action']) || empty($_POST['action']) || ($_POST['action'] !== 'add' &&  $_POST['action'] !== 'approve' && $_POST['action'] !== 'delete')) {
    header("Location: ../view/");
    exit();
}

$article = new Article();
session_start();
if ($_POST['action'] === 'add') {
    if (!empty($_POST['titreArticle']) && !empty($_POST['contenuArticle']) && !empty($_POST['idTheme'])) {
        $article->setTitreArticle($_POST['titreArticle']);
        $article->setContenuArticle($_POST['contenuArticle']);
        $article->setIdTheme((int)$_POST['idTheme']);
        $article->setMedia("https://www.w3schools.com/howto/img_avatar.png");
        $article->setIdAuteur((int) $_SESSION['Utilisateur']->getIdUtilisateur());
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
} elseif ($_POST['action'] === 'delete' && isset($_POST['idArticle'])) {
    if ($article->supprimerArticle((int)$_POST['idArticle'])) {
        header("Location: ../view/admin_articles.php?status=success");
        exit();
    } else {
        header("Location: ../view/admin_articles.php?status=error");
        exit();
    }
} elseif ($_POST['action'] === 'approve' && isset($_POST['idArticle'])) {
    if ($article->validerArticle((int)$_POST['idArticle'])) {
        header("Location: ../view/admin_articles.php?status=success");
        exit();
    } else {
        header("Location: ../view/admin_articles.php?status=error");
        exit();
    }
}
