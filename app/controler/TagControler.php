<?php

namespace app\controler;

require_once __DIR__ . '/../../vendor/autoload.php';

use app\model\Tag;

$tag     = new Tag();

if (isset($_POST['nomTag']) && !empty($_POST['nomTag'])) {
    $tag->setNomTag($_POST['nomTag']);
    if ($tag->ajouterTag()) {
        header("Location: ../view/admin_tags.php?status=success");
        exit();
    } else {
        header("Location: ../view/admin_tags.php?status=error");
        exit();
    }
} else {
    header("Location: ../view/admin_tags.php?status=invalid");
    exit();
}
