
<?php

use app\model\Tag;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['tag_name']) && !empty($_POST['tag_name'])) {
        $tag = new Tag();
        $tag->setNomTag($_POST['tag_name']);
        if ($tag->ajouterTag()) {
            header('Location: ../view/admin_tags.php?status=success');
            exit();
        } else {
            header('Location: ../view/admin_tags.php?status=error');
            exit();
        }
    }
    header('Location: ../view/admin_tags.php');
    exit();
} else {
    header('Location: ../view/admin_tags.php');
    exit();
}
