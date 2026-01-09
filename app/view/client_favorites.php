<?php

namespace app\view;

use app\model\AimerArticle;
use app\model\Article;
use app\model\Theme;
use DateTime;

require_once __DIR__ . '/../../vendor/autoload.php';




session_start();
$connect = true;
if (!isset($_SESSION['Utilisateur']) or  $_SESSION['Utilisateur']->getRole() !== 'client') {
    $connect =  false;
    header("Location: login.php");
} else {

    $article = new Article();

    $articles = $article->getArticlesFavorisByClient($_SESSION['Utilisateur']->getIdUtilisateur());
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MaBagnole | Mes Favoris</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;800&display=swap');

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
        }
    </style>
</head>

<body class="bg-slate-50 min-h-screen">

    <nav class="flex justify-between items-center px-8 py-5 bg-white border-b border-slate-100 sticky top-0 z-50">
        <div class="text-2xl font-black text-blue-600">Ma<span class="text-slate-800">Bagnole</span></div>
        <div class="flex items-center gap-6">
            <a href="accueil.php" class="text-sm font-bold text-slate-500 hover:text-blue-600 transition">Browser Cars </a>
            <a href="themes.php" class="text-sm font-bold text-slate-500 hover:text-blue-600 transition">Themes </a>
            <?php if ($connect): ?>
                <a href="./client_favorites.php" class="text-sm font-bold text-slate-500 hover:text-blue-600 transition">Favoris</a>
            <?php endif; ?>
        </div>
        <div class="flex gap-4 w-full md:w-auto">

        </div>
    </nav>
    <main class="max-w-7xl mx-auto px-6 py-12">

        <div class="flex flex-col md:flex-row justify-between items-center mb-12 gap-6">
            <div class="text-center md:text-left">
                <h1 class="text-4xl font-black text-slate-900 mb-2">Ma <span class="text-red-500">Bibliothèque</span></h1>
                <p class="text-slate-500 font-medium">Retrouvez ici tous les articles que vous avez aimés.</p>
            </div>
            <div class="bg-white px-6 py-4 rounded-[1.5rem] shadow-sm border border-slate-100 flex items-center gap-4">
                <div class="w-10 h-10 bg-red-50 text-red-500 rounded-full flex items-center justify-center">
                    <i class="fas fa-heart"></i>
                </div>
                <div>
                    <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Total Favoris</p>
                    <p class="text-lg font-black text-slate-800"><?= count($articles) ?></p>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8" id="favoritesGrid">
            <?php foreach ($articles as $article) : ?>
                <div class="bg-white rounded-[2.5rem] border border-slate-100 overflow-hidden shadow-sm hover:shadow-xl transition-all duration-300 group">
                    <div class="h-48 overflow-hidden relative">
                        <img src="https://images.unsplash.com/photo-1503376780353-7e6692767b70?w=1200" class="w-full h-full object-cover">
                        <form>
                            <input type="hidden" name="idClient" value="<?= $_SESSION['Utilisateur']->getIdUtilisateur() ?>">
                            <input type="hidden" name="idArticle" value="<?= $article->getIdArticle() ?>">
                            <button type="button" <?php if (!($connect)) :  ?>
                                onclick="toggleModal('rentPopup')" <?php else:; ?>
                                onclick="toggleFavorite(this)" <?php endif; ?>
                                class="absolute   
                                <?php if (($connect)) echo ' favorite-btn ';
                                $aimeArticle = new AimerArticle();
                                if ($aimeArticle->isAimerArticle($_SESSION['Utilisateur']->getIdUtilisateur(), $article->getIdArticle()))
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
                                <?php
                                $theme = new Theme();
                                $theme = $theme->getThemeById($article->getIdTheme());
                                echo $theme->getNomTheme(); ?>
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

        <div id="emptyState" class="hidden flex flex-col items-center justify-center py-24 text-center">
            <div class="w-32 h-32 bg-slate-100 rounded-full flex items-center justify-center text-slate-300 text-5xl mb-6">
                <i class="far fa-bookmark"></i>
            </div>
            <h2 class="text-2xl font-black text-slate-800 mb-2">Votre liste est vide</h2>
            <p class="text-slate-500 mb-8 max-w-xs mx-auto">Vous n'avez pas encore enregistré d'articles. Explorez notre blog pour en trouver !</p>
            <a href="articles_list.php" class="bg-blue-600 text-white px-8 py-4 rounded-2xl font-black shadow-lg shadow-blue-100 hover:bg-blue-700 transition">
                Découvrir le Blog
            </a>
        </div>
    </main>


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

                            location.reload();
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

        function confirmUnfavorite(id, title) {
            const modal = document.getElementById('actionModal');
            const msg = document.getElementById('modalMsg');
            const btn = document.getElementById('confirmBtn');

            msg.innerText = `Voulez-vous retirer l'article "${title}" de vos favoris ?`;

            btn.onclick = () => {
                // Simulation Suppression Visuelle
                const card = document.getElementById('fav-card-' + id);
                card.style.opacity = '0';
                card.style.transform = 'scale(0.9)';

                setTimeout(() => {
                    card.remove();
                    closeModal();
                    checkEmpty();
                }, 300);
            };

            modal.classList.remove('hidden');
            modal.classList.add('flex');
        }

        function closeModal() {
            const modal = document.getElementById('actionModal');
            modal.classList.add('hidden');
            modal.classList.remove('flex');
        }

        function checkEmpty() {
            const grid = document.getElementById('favoritesGrid');
            const empty = document.getElementById('emptyState');
            if (grid.children.length === 0) {
                empty.classList.remove('hidden');
            }
        }
    </script>
</body>

</html>