<?php

namespace App\Controler;

use app\model\AimerArticle;

header('Content-Type: application/json');
try {
    session_start();
    $favoriArticle = new AimerArticle();
    $favoriArticle->setIdClient((int) $_SESSION['Utilisateur']->getIdUtilisateur());
    $favoriArticle->setIdArticle((int) $_POST['idArticle']);
    if ($favoriArticle->isAimerArticle($favoriArticle->getIdClient(), $favoriArticle->getIdArticle())) {
        $favoriArticle->annulerAimerArticle();
    } else {
        $favoriArticle->aimerArticle();
    }
    echo json_encode(['success' => true, 'message' => 'Aimer ajouter']);
} catch (\Exception $e) {
    error_log(date('y-m-d h:i:s') . " Connexion :error ." . $e . PHP_EOL, 3, "error.log");
    echo json_encode(['success' => false, 'message' => 'Aimer non ajouter']);
}
  echo json_encode(['success' => true, 'message' => 'Aimer ajouter']);