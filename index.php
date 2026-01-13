<?php


$uri = $_SERVER['REQUEST_URI'];
$route = explode("/", $uri);


switch ($route[2]) {
    case '':
        require_once('app/view/index.php');
        break;

    case 'accueil':
        require_once('app/view/accueil.php');
        break;

    case 'login':
        require_once('app/view/login.php');
        break;

    case 'register':
        require_once('app/view/register.php');
        break;
    case 'dashboard':
        require_once('app/view/admin_dashboard.php');
        break;

    case 'admin_categories':
        require_once('app/view/admin_categories.php');
        break;
    case 'admin_clients':
        require_once('app/view/admin_clients.php');
        break;
    case 'admin_fleet':
        require_once('app/view/admin_fleet.php');
        break;
    case 'admin_reservations':
        require_once('app/view/admin_reservations.php');
        break;
    case 'admin_reviews':
        require_once('app/view/admin_reviews.php');
        break;
    case 'AdminControler':
        require_once('app/controler/AdminControler.php');
        break;
    case 'UtilisateurControler':
        require_once('app/controler/UtilisateurControler.php');
        break;
    case 'ClientControler':
        require_once('app/controler/ClientControler.php');
        break;
    default:
        require_once('app/view/404.php');
        break;
}
