<?php

namespace app\controler;

require_once __DIR__ . '/../../vendor/autoload.php';

use app\model\Theme;

$theme = new Theme();

if (isset($_POST['descriptionTheme']) && isset($_POST['descriptionTheme'])) {
    $theme->setNomTheme($_POST['nomTheme']);
    $theme->setDescriptionTheme($_POST['descriptionTheme']);
    if ($theme->ajouterTheme()) {
        header("Location: ../view/admin_themes.php?status=success");
        exit();
    } else {
        header("Location: ../view/admin_themes.php?status=error");
        exit();
    }
} else {
    header("Location: ../view/admin_themes.php?status=invalid");
    exit();
}
