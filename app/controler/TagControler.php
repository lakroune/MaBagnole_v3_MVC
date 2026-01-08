<?php

namespace app\controler;

require_once __DIR__ . '/../../vendor/autoload.php';

use app\model\Tag;

$tag = new Tag();



if ($_SERVER['REQUEST_METHOD'] !== 'POST' || !isset($_POST['action']) || empty($_POST['action']) || ($_POST['action'] !== 'add' && $_POST['action'] !== 'delete')) {
    header("Location: ../view/admin_tags.php");
    exit();
}

if ($_POST['action'] === 'add' && isset($_POST['nomTag'])) {
    $tag->setNomTag($_POST['nomTag']);
    if ($tag->ajouterTag()) {
        header("Location: ../view/admin_tags.php?status=success");
        exit();
    } else {
        header("Location: ../view/admin_tags.php?status=error");
        exit();
    }
} elseif ($_POST['action'] === 'delete' && isset($_POST['idTag'])) {
    if ($tag->supprimerTag((int)$_POST['idTag'])) {
        header("Location: ../view/admin_tags.php?status=success");
        exit();
    } else {
        header("Location: ../view/admin_tags.php?status=error");
        exit();
    }
}
