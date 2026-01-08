<?php

namespace app\view;

require_once __DIR__ . '/../../vendor/autoload.php';

use app\model\Article;
use app\model\Theme;
use app\model\Client;
use DateTime;

$themesList = Theme::getAllTheme();
$articlesList = Article::getAllArticles();
$client = new Client();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MaBagnole | Blog & Themes</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        .theme-card:hover .theme-icon {
            transform: scale(1.1) rotate(-5deg);
        }

        .sticky-search {
            position: sticky;
            top: 0;
            z-index: 40;
        }
    </style>
</head>

<body class="bg-slate-50 min-h-screen">

    <header class="bg-white border-b border-slate-100 px-8 py-12">
        <div class="max-w-7xl mx-auto flex flex-col md:flex-row justify-between items-center gap-6">
            <div>
                <h1 class="text-4xl font-black text-slate-900 mb-2">MaBagnole <span class="text-blue-600">Blog</span></h1>
                <p class="text-slate-500 font-medium">Partagez votre passion pour l'automobile avec la communauté.</p>
            </div>


        </div>

        <div class="max-w-4xl mx-auto mt-10">
            <div class="relative group">
            </div>


        </div>
    </header>

    <main class="max-w-7xl mx-auto px-8 py-12">
        <h2 class="text-2xl font-black text-slate-800 mb-8 flex items-center gap-3">
            <i class="fas fa-layer-group text-blue-600"></i> Explorer par Thèmes
        </h2>

        <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-4 mb-16">
            <?php foreach ($themesList as $theme) :  ?>
                <a href="./articles_list.php?id=<?= $theme->getIdTheme() ?>" class="theme-card bg-white p-6 rounded-[2rem] border border-slate-100 text-center hover:border-blue-500 transition-all shadow-sm group">
                    <div class="theme-icon w-12 h-12 bg-blue-50 text-blue-600 rounded-2xl flex items-center justify-center mx-auto mb-3 transition-transform">
                        <i class="fas fa-road text-xl"></i>
                    </div>
                    <p class="font-black text-slate-800 text-sm group-hover:text-blue-600 transition">Voyages</p>
                </a>
            <?php endforeach; ?>
        </div>

        <div class="flex justify-between items-end mb-8">
            <h2 class="text-2xl font-black text-slate-800">Articles Récents</h2>
            <div class="flex items-center gap-3 text-sm font-bold text-slate-400">

            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <?php foreach ($articlesList as $article) :  ?>

                <div class="bg-white rounded-[2.5rem] overflow-hidden border border-slate-100 shadow-sm hover:shadow-xl transition group">
                    <div class="h-52 overflow-hidden relative">
                        <img src="https://images.unsplash.com/photo-1492144534655-ae79c964c9d7?w=800" class="w-full h-full object-cover">
                        <button class="absolute top-4 right-4 w-10 h-10 bg-white/90 backdrop-blur rounded-full flex items-center justify-center text-slate-400 hover:text-red-500 transition shadow-sm">
                            <i class="fas fa-heart"></i>
                        </button>
                    </div>
                    <div class="p-8">
                        <div class="flex items-center gap-2 mb-3">
                            <span class="text-[10px] font-black uppercase tracking-widest text-blue-600">"theme"</span>
                            <span class="text-slate-300">•</span>
                            <span class="text-[10px] font-bold text-slate-400">
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
                                    echo "À l\'instant";
                                }

                                ?></span>
                        </div>
                        <h3 class="text-xl font-black text-slate-800 mb-4 group-hover:text-blue-600 transition"><?php echo $article->getTitreArticle(); ?></h3>
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-2">
                                <div class="w-8 h-8 rounded-full bg-slate-100 overflow-hidden border-2 border-white shadow-sm">
                                    <img src="https://i.pravatar.cc/100?u=ahmed">
                                </div>
                                <span class="text-xs font-bold text-slate-600">Ahmed B.</span>
                            </div>
                            <a href="article_detail.php?id=<?php echo $article->getIdArticle(); ?>" class="text-xs font-black text-blue-600 flex items-center gap-1 hover:gap-2 transition-all">
                                Lire <i class="fas fa-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>


    </main>


    <script>
        function toggleModal(id) {
            const modal = document.getElementById(id);
            modal.classList.toggle('hidden');
            modal.classList.toggle('flex');
        }
    </script>
</body>

</html>