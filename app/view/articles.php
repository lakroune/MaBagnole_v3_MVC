<?php

namespace app\view;

require_once __DIR__ . '/../../vendor/autoload.php';

use app\model\AimerArticle;
use app\model\Theme;
use app\model\Article;
use app\model\Tag;
use DateTime;

session_start();
$connect = true;
$iduser =0;
if (!isset($_SESSION['Utilisateur']) or  $_SESSION['Utilisateur']->getRole() !== 'client') {
    $connect =  false;
 
}
else{
    $iduser = $_SESSION['Utilisateur']->getIdUtilisateur();
}
if (!isset($_GET['id']) || empty($_GET['id'])) {
    header("Location: themes.php");
    exit();
}

$tags = Tag::getAllTag();
try {
    $idTheme = (int)($_GET['id']);
    $articles = [];
    $theme = new Theme();
    $theme = $theme->getThemeById($idTheme);
} catch (\Exception $e) {
    header("Location: themes_list.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && ((isset($_POST['search']) && !empty($_POST['search'])) || (isset($_POST['tag']) && !empty($_POST['tag'])))) {
    $search = $_POST['search'];
    $tag = $_POST['tag'];
    $art = new Article();
    if (!empty($tag) && $tag !== '') {
        $articles = $art->feltrerArticlesParTag($tag, $idTheme);
    } elseif (!empty($search) && $search !== '') {
        $articles = $art->rechercherArticlesParTitre($search, $idTheme);
    }
} else {
    $articles = Article::getArticlesByTheme($idTheme);
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MaBagnole | Liste des Articles</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        .font-outline-2 {
            -webkit-text-stroke: 1px #3b82f6;
            color: transparent;
        }

        .is-favorite {
            color: #ef4444 !important;
            background-color: white !important;
        }

        @keyframes heartBeat {
            0% {
                transform: scale(1);
            }

            50% {
                transform: scale(1.3);
            }

            100% {
                transform: scale(1);
            }
        }

        .car-card:hover {
            transform: translateY(-10px);
        }


        .dataTables_wrapper .dataTables_paginate .paginate_button.current {
            background: #2563eb !important;
            color: white !important;
            border: none !important;
            border-radius: 0.75rem;
        }

        table.dataTable.no-footer {
            border-bottom: none !important;
        }

        .dataTables_info {
            color: #64748b !important;
            font-size: 0.875rem;
            margin-top: 20px;
        }
    </style>
</head>

<body class="bg-slate-50 min-h-screen">

    <nav class="bg-white border-b border-slate-100 sticky top-0 z-50 px-8 py-5">
        <div class="max-w-7xl mx-auto flex justify-between items-center">
            <div class="text-2xl font-black text-blue-600">Ma<span class="text-slate-800">Bagnole</span></div>
            <div class="flex items-center gap-6">
                <a href="accueil.php" class="text-sm font-bold text-slate-500 hover:text-blue-600 transition"> Browse cars </a>
                <?php if ($connect): ?>
                    <a href="client_favorites.php" class="text-sm font-bold text-slate-500 hover:text-blue-600 transition">Favoris</a>
                <?php endif; ?>
            </div>
            <?php include('infoClient.php');  ?>
        </div>

    </nav>

    <header class="py-12 bg-white border-b border-slate-100 shadow-sm">
        <div class="max-w-5xl mx-auto px-6">
            <h1 class="text-3xl font-black text-slate-900 mb-8 text-center">Découvrez nos <span class="text-blue-600">Publications</span></h1>

            <form action="" method="POST" class="grid grid-cols-1 md:grid-cols-12 gap-4">
                <div class="md:col-span-6 relative">
                    <i class="fas fa-search absolute left-4 top-1/2 -translate-y-1/2 text-slate-400 text-sm"></i>
                    <input type="text" name="search" placeholder="Rechercher par titre..."
                        <?php
                        if (isset($search) && !empty($search))  echo 'value="' . htmlspecialchars($search) . '"';
                        ?>
                        class="w-full pl-11 pr-4 py-3.5 bg-slate-50 border border-slate-100 rounded-2xl outline-none focus:ring-2 focus:ring-blue-500 transition text-sm">
                </div>

                <div class="md:col-span-4 relative">
                    <i class="fas fa-tag absolute left-4 top-1/2 -translate-y-1/2 text-slate-400 text-sm"></i>
                    <select name="tag" class="w-full pl-11 pr-4 py-3.5 bg-slate-50 border border-slate-100 rounded-2xl outline-none focus:ring-2 focus:ring-blue-500 transition text-sm appearance-none cursor-pointer">
                        <option value="">Filtrer par Tag</option>
                        <?php foreach ($tags as $tag) : ?>
                            <option <?php if (isset($_GET['tag']) && $_GET["tag"] == $tag->getIdTag()) echo 'selected'; ?> value="<?= $tag->getIdTag() ?>">
                                <?= htmlspecialchars($tag->getNomTag()) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                    <i class="fas fa-chevron-down absolute right-4 top-1/2 -translate-y-1/2 text-slate-300 pointer-events-none text-xs"></i>
                </div>

                <div class="md:col-span-2">
                    <button type="submit" class="w-full bg-blue-600 text-white py-3.5 rounded-2xl font-black text-sm hover:bg-blue-700 transition shadow-lg shadow-blue-100">
                        Filtrer
                    </button>
                </div>
            </form>
        </div>
    </header>

    <main class="max-w-7xl mx-auto px-8 py-12">
        <div class="flex flex-wrap justify-between items-center mb-10 gap-4">
            <p class="text-xs font-black text-slate-400 uppercase tracking-widest">Articles disponibles (<?= count($articles) ?>)</p>

        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <?php foreach ($articles as $article) : ?>
                <div class="bg-white rounded-[2.5rem] border border-slate-100 overflow-hidden shadow-sm hover:shadow-xl transition-all duration-300 group">
                    <div class="h-48 overflow-hidden relative">
                        <img src="https://images.unsplash.com/photo-1503376780353-7e6692767b70?w=1200" class="w-full h-full object-cover">
                        <form>
                            <input type="hidden" name="idClient" value="<?php  echo $iduser ?>">
                            <input type="hidden" name="idArticle" value="<?= $article->getIdArticle() ?>">
                            <button type="button" <?php if (!($connect)) :  ?>
                                onclick="toggleModal('rentPopup')" <?php else:; ?>
                                onclick="toggleFavorite(this)" <?php endif; ?>
                                class="absolute   
                                <?php if (($connect)) echo ' favorite-btn ';
                                $aimeArticle = new AimerArticle();
                                if ($aimeArticle->isAimerArticle($iduser, $article->getIdArticle()))
                                    echo ' is-favorite ';
                                ?>
                                    top-4 right-4 w-9 h-9 bg-white/90 backdrop-blur rounded-full flex items-center justify-center text-slate-400 hover:text-red-500 transition">
                                <i class="fas fa-heart"></i>
                            </button>
                        </form>
                    </div>
                    <div class="p-6">
                        <div class="flex items-center gap-2 mb-3">
                            <span class="text-[10px] font-black text-blue-600 uppercase tracking-tighter bg-blue-50 px-2 py-0.5 rounded">
                                <?= $theme->getNomTheme()  ?>
                            </span>
                            <span class="text-[10px] font-bold text-slate-300 uppercase">
                                <?php
                                $toDay = new DateTime();
                                $articleDate = new DateTime($article->getDatePublicationArticle());
                                $interval = $toDay->diff($articleDate);
                                if ($interval->d > 0) {
                                    echo $interval->d . ' jours';
                                } elseif ($interval->h > 0) {
                                    echo $interval->h . ' heures';
                                } elseif ($interval->i > 0) {
                                    echo $interval->i . ' minutes';
                                } else {
                                    echo "À l'instant";
                                }

                                ?>
                            </span>
                        </div>
                        <h3 class="text-lg font-black text-slate-800 mb-3 group-hover:text-blue-600 transition leading-tight"><?= $article->getTitreArticle() ?></h3>
                        <p class="text-sm text-slate-500 line-clamp-2 mb-6"><?= htmlspecialchars($article->getContenuArticle()) ?>.</p>

                        <a href="article_detail.php?id=<?= $article->getIdArticle() ?>" class="inline-flex items-center text-xs font-black text-slate-900 group-hover:text-blue-600 transition">
                            Lire l'article <i class="fas fa-arrow-right ml-2 group-hover:translate-x-1 transition-transform"></i>
                        </a>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </main>

    <div id="rentPopup" class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm hidden items-center justify-center z-[100] p-4">
        <div class="bg-white w-full max-w-md rounded-[2.5rem] p-8 shadow-2xl text-center relative">
            <button onclick="toggleModal('rentPopup')" class="absolute top-6 right-6 text-slate-300 hover:text-slate-600"><i class="fas fa-times"></i></button>

            <div class="w-20 h-20 bg-blue-50 text-blue-600 rounded-full flex items-center justify-center mx-auto mb-6 text-3xl">
                <i class="fas fa-lock"></i>
            </div>
            <h3 class="text-2xl font-black text-slate-800 mb-2">Login Required</h3>
            <p class="text-slate-500 text-sm mb-8 leading-relaxed">You need to be logged in to book this vehicle and manage your reservations.</p>

            <div class="flex flex-col gap-3">
                <a href="login.php" class="w-full bg-blue-600 text-white py-4 rounded-2xl font-black shadow-lg shadow-blue-100 hover:bg-blue-700 transition">Sign In Now</a>
                <a href="register.php" class="w-full bg-slate-50 text-slate-600 py-4 rounded-2xl font-bold hover:bg-slate-100 transition">Create an Account</a>
            </div>
        </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="js/main.js"></script>

    <script>
        $(document).ready(function() {

            $('.favorite-btn').on('click', function(e) {
                e.preventDefault();

                const $btn = $(this);
                const $form = $btn.closest('form');
                const formData = $form.serialize();
                $.ajax({
                    url: '../controler/AimerArticleControler.php',
                    type: 'POST',
                    data: formData,
                    dataType: 'json',
                    success: function(response) {
                        if (response.success) {
                            console.log('success');
                        } else {
                            console.log('failed');
                        }
                    },
                    error: function() {
                        console.log('error');
                    }
                });
            });
        });

        function toggleModal(id) {
            const modal = document.getElementById(id);
            modal.classList.toggle('hidden');
            modal.classList.toggle('flex');
        }
    </script>


</body>

</html>