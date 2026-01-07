<?php

use app\model\Theme;

$theme = new Theme();

if (isset($_GET['nomTheme']) && isset($_GET['descriptionTheme'])) {
    $theme->setNomTheme($_GET['nomTheme']);
    $theme->setDescriptionTheme($_GET['descriptionTheme']);
    if ($theme->ajouterTheme()) {
        header("Location: admin_themes?status=success");
        exit();
    } else {
        header("Location: admin_themes?status=error");
        exit();
    }
} else {
    header("Location: admin_themes?status=error");
    exit();
}
