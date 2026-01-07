<?php

namespace app\view;

require_once __DIR__ . '/../../vendor/autoload.php';

use app\model\Theme;
use app\model\Article;

if (!isset($_GET['id']) || empty($_GET['id'])) {
    header("Location: themes_list.php");
    exit();
}

try {
    $articles = Article::getArticlesByTheme($_GET['id']);
    $theme = new Theme();
    $theme =$theme->getThemeById($_GET['id']);
} catch (\Exception $e) {
    header("Location: themes_list.php");
    exit();
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
</head>

<body class="bg-slate-50 min-h-screen">

    <nav class="bg-white border-b border-slate-100 sticky top-0 z-50 px-8 py-5">
        <div class="max-w-7xl mx-auto flex justify-between items-center">
            <div class="text-2xl font-black text-blue-600">Ma<span class="text-slate-800">Bagnole</span></div>
            <div class="flex items-center gap-6">
                <a href="blog_main.php" class="text-sm font-bold text-slate-500 hover:text-blue-600 transition">Thèmes</a>
                <a href="catalogue.php" class="text-sm font-bold text-slate-500 hover:text-blue-600 transition">Catalogue</a>
                <div class="w-10 h-10 rounded-full bg-slate-100 border-2 border-white shadow-sm overflow-hidden">
                    <img src="https://i.pravatar.cc/100?u=me">
                </div>
            </div>
        </div>
    </nav>

    <header class="py-12 bg-white border-b border-slate-100 shadow-sm">
        <div class="max-w-5xl mx-auto px-6">
            <h1 class="text-3xl font-black text-slate-900 mb-8 text-center">Découvrez nos <span class="text-blue-600">Publications</span></h1>

            <form action="" method="GET" class="grid grid-cols-1 md:grid-cols-12 gap-4">
                <div class="md:col-span-6 relative">
                    <i class="fas fa-search absolute left-4 top-1/2 -translate-y-1/2 text-slate-400 text-sm"></i>
                    <input type="text" name="search" placeholder="Rechercher par titre..."
                        class="w-full pl-11 pr-4 py-3.5 bg-slate-50 border border-slate-100 rounded-2xl outline-none focus:ring-2 focus:ring-blue-500 transition text-sm">
                </div>

                <div class="md:col-span-4 relative">
                    <i class="fas fa-tag absolute left-4 top-1/2 -translate-y-1/2 text-slate-400 text-sm"></i>
                    <select name="tag" class="w-full pl-11 pr-4 py-3.5 bg-slate-50 border border-slate-100 rounded-2xl outline-none focus:ring-2 focus:ring-blue-500 transition text-sm appearance-none cursor-pointer">
                        <option value="">Tous les Tags</option>
                        <option value="vitesse">#Vitesse</option>
                        <option value="ecomobilite">#Ecomobilité</option>
                        <option value="entretien">#Entretien</option>
                        <option value="luxe">#Luxe</option>
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
                    <img src="https://images.unsplash.com/photo-1542362567-b055002b91f4?w=800" class="w-full h-full object-cover">
                    <button class="absolute top-4 right-4 w-9 h-9 bg-white/90 backdrop-blur rounded-full flex items-center justify-center text-slate-400 hover:text-red-500 transition">
                        <i class="fas fa-heart"></i>
                    </button>
                </div>
                <div class="p-6">
                    <div class="flex items-center gap-2 mb-3">
                        <span class="text-[10px] font-black text-blue-600 uppercase tracking-tighter bg-blue-50 px-2 py-0.5 rounded">
                            <?= $theme->getNomTheme()  ?>
                        </span>
                        <span class="text-[10px] font-bold text-slate-300 uppercase"><?= "date" ?></span>
                    </div>
                    <h3 class="text-lg font-black text-slate-800 mb-3 group-hover:text-blue-600 transition leading-tight"><?= $article->getTitreArticle() ?></h3>
                    <p class="text-sm text-slate-500 line-clamp-2 mb-6"><?= $article->getContenuArticle() ?>.</p>

                    <a href="article_detail.php?id=1" class="inline-flex items-center text-xs font-black text-slate-900 group-hover:text-blue-600 transition">
                        Lire l'article <i class="fas fa-arrow-right ml-2 group-hover:translate-x-1 transition-transform"></i>
                    </a>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </main>

</body>

</html>