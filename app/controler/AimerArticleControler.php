<?php

namespace App\Controler;
require_once __DIR__ . '/../../vendor/autoload.php';
use app\model\AimerArticle;


header('Content-Type: application/json');
try {
    session_start();
    $favoriArticle = new AimerArticle();
    $favoriArticle->setIdClient((int) $_SESSION['Utilisateur']->getIdUtilisateur());
    $favoriArticle->setIdArticle((int) $_POST['idArticle']);
    if ($favoriArticle->aimerArticle()) {
        echo json_encode(['success' => true, 'message' => 'Aimer article ajouter']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Aimer article ajouter']);
    }
} catch (\Exception $e) {
    echo json_encode(['error' => true, 'message' => 'Aimer article non ajouter']);
}
