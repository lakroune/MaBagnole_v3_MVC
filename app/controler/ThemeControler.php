<?php

namespace app\controler;

require_once __DIR__ . '/../../vendor/autoload.php';

use app\model\Theme;

$theme = new Theme();
if ($_SERVER['REQUEST_METHOD'] !== 'POST' || !isset($_POST['action']) || empty($_POST['action']) || ($_POST['action'] !== 'add' && $_POST['action'] !== 'edit' && $_POST['action'] !== 'delete')) {
    header("Location: ../view/admin_themes.php");
    exit();
}
if ($_POST['action'] === 'add' && isset($_POST['nomTheme']) &&  isset($_POST['descriptionTheme'])) {
    $theme->setNomTheme($_POST['nomTheme']);
    $theme->setDescriptionTheme($_POST['descriptionTheme']);
    if ($theme->ajouterTheme()) {
        header("Location: ../view/admin_themes.php?status=success");
        exit();
    } else {
        header("Location: ../view/admin_themes.php?status=error");
        exit();
    }
} elseif ($_POST['action'] === 'edit' && isset($_POST['idTheme']) && isset($_POST['nomTheme']) &&  isset($_POST['descriptionTheme'])) {
    $theme->setIdTheme($_POST['idTheme']);
    $theme->setNomTheme($_POST['nomTheme']);
    $theme->setDescriptionTheme($_POST['descriptionTheme']);
    if ($theme->modifierTheme()) {
        header("Location: ../view/admin_themes.php?status=success");
        exit();
    } else {
        header("Location: ../view/admin_themes.php?status=error");
        exit();
    }
} elseif ($_POST['action'] === 'delete' && isset($_POST['idTheme'])) {
    if ($theme->supprimerTheme((int)$_POST['idTheme'])) {
        header("Location: ../view/admin_themes.php?status=success");
        exit();
    } else {
        header("Location: ../view/admin_themes.php?status=error");
        exit();
    }
}
