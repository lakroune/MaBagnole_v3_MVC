<?php

namespace app\view;

require_once __DIR__ . '../../../vendor/autoload.php';

use app\model\Article;
use app\model\Theme;

$themes = Theme::getAllTheme();


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MaBagnole | Parcourir les Thèmes</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>

<body class="bg-slate-50 min-h-screen">

    <nav class="flex justify-between items-center px-8 py-5 bg-white border-b border-slate-100 sticky top-0 z-50">
        <div class="text-2xl font-black text-blue-600">Ma<span class="text-slate-800">Bagnole</span></div>
        <div class="flex items-center gap-6">
            <a href="blog_main.php" class="text-sm font-bold text-slate-500 hover:text-blue-600 transition">Blog</a>
            <a href="catalogue.php" class="text-sm font-bold text-slate-500 hover:text-blue-600 transition">Véhicules</a>
            <div class="w-10 h-10 rounded-full bg-slate-100 border-2 border-white shadow-sm overflow-hidden">
                <img src="https://i.pravatar.cc/100?u=me">
            </div>
        </div>
        <div class="flex gap-4 w-full md:w-auto">
            <button onclick="toggleModal('addArticleModal')" class="bg-slate-900 text-white px-6 py-4 rounded-2xl font-black hover:bg-blue-600 transition flex items-center gap-2 shadow-lg">
                <i class="fas fa-plus"></i> Nouveau Article
            </button>
        </div>
    </nav>

    <header class="py-16 bg-white border-b border-slate-100 text-center px-4">

        <h1 class="text-4xl font-black text-slate-900 mb-4">Explorez par <span class="text-blue-600">Thématiques</span></h1>
        <p class="text-slate-500 max-w-xl mx-auto font-medium">
            Trouvez des articles passionnants classés par catégories pour approfondir vos connaissances automobiles.
        </p>
        <div class="max-w-4xl mx-auto mt-10">
            <form action="" method="POST">
                <div class="relative group">
                    <i class="fas fa-search absolute left-5 top-1/2 -translate-y-1/2 text-slate-400 group-focus-within:text-blue-600 transition"></i>
                    <input type="text" placeholder="Rechercher un titre d'article..."
                        class="w-full pl-14 pr-32 py-5 bg-slate-50 border border-slate-200 rounded-2xl outline-none focus:ring-4 focus:ring-blue-500/10 transition shadow-sm">
                </div>
            </form>


        </div>
    </header>

    <main class="max-w-7xl mx-auto px-8 py-16">
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
            <?php foreach ($themes as $theme) : ?>
                <a href="articles_list.php?id=<?= $theme->getIdTheme() ?>" class="group relative bg-white rounded-[2.5rem] p-8 border border-slate-100 shadow-sm hover:shadow-2xl hover:-translate-y-2 transition-all duration-300 overflow-hidden">
                    <div class="absolute -right-4 -top-4 w-24 h-24 bg-blue-50 rounded-full group-hover:scale-[3] transition-transform duration-700"></div>

                    <div class="relative z-10">
                        <div class="w-16 h-16 bg-blue-600 text-white rounded-2xl flex items-center justify-center text-2xl shadow-lg shadow-blue-100 mb-6">
                            <i class="fas fa-road"></i>
                        </div>
                        <h3 class="text-2xl font-black text-slate-800 mb-2"><?= $theme->getNomTheme() ?></h3>
                        <p class="text-slate-500 text-sm leading-relaxed mb-6">
                            <?= $theme->getDescriptionTheme() ?>
                        </p>
                        <div class="flex items-center justify-between">
                            <span class="text-xs font-black text-blue-600 uppercase tracking-widest"><?= Article::nbArticlesByTheme($theme->getIdTheme()) ?> Articles</span>
                            <div class="w-8 h-8 rounded-full bg-slate-50 flex items-center justify-center text-slate-400 group-hover:bg-blue-600 group-hover:text-white transition">
                                <i class="fas fa-arrow-right text-xs"></i>
                            </div>
                        </div>
                    </div>
                </a>
            <?php endforeach; ?>
            <!-- <a href="theme_articles.php?id=2" class="group relative bg-white rounded-[2.5rem] p-8 border border-slate-100 shadow-sm hover:shadow-2xl hover:-translate-y-2 transition-all duration-300 overflow-hidden">
                <div class="absolute -right-4 -top-4 w-24 h-24 bg-slate-50 rounded-full group-hover:scale-[3] transition-transform duration-700"></div>
                <div class="relative z-10">
                    <div class="w-16 h-16 bg-slate-900 text-white rounded-2xl flex items-center justify-center text-2xl shadow-lg mb-6">
                        <i class="fas fa-tools"></i>
                    </div>
                    <h3 class="text-2xl font-black text-slate-800 mb-2">Entretien & Mécanique</h3>
                    <p class="text-slate-500 text-sm leading-relaxed mb-6">
                        Apprenez à prendre soin de votre moteur et à maintenir votre véhicule dans un état irréprochable.
                    </p>
                    <div class="flex items-center justify-between">
                        <span class="text-xs font-black text-slate-400 uppercase tracking-widest">8 Articles</span>
                        <div class="w-8 h-8 rounded-full bg-slate-50 flex items-center justify-center text-slate-400 group-hover:bg-slate-900 group-hover:text-white transition">
                            <i class="fas fa-arrow-right text-xs"></i>
                        </div>
                    </div>
                </div>
            </a>

            <a href="theme_articles.php?id=3" class="group relative bg-white rounded-[2.5rem] p-8 border border-slate-100 shadow-sm hover:shadow-2xl hover:-translate-y-2 transition-all duration-300 overflow-hidden">
                <div class="absolute -right-4 -top-4 w-24 h-24 bg-green-50 rounded-full group-hover:scale-[3] transition-transform duration-700"></div>
                <div class="relative z-10">
                    <div class="w-16 h-16 bg-green-500 text-white rounded-2xl flex items-center justify-center text-2xl shadow-lg shadow-green-100 mb-6">
                        <i class="fas fa-leaf"></i>
                    </div>
                    <h3 class="text-2xl font-black text-slate-800 mb-2">Écomobilité</h3>
                    <p class="text-slate-500 text-sm leading-relaxed mb-6">
                        Tout sur les voitures électriques, hybrides et les nouvelles technologies respectueuses de l'environnement.
                    </p>
                    <div class="flex items-center justify-between">
                        <span class="text-xs font-black text-green-600 uppercase tracking-widest">15 Articles</span>
                        <div class="w-8 h-8 rounded-full bg-slate-50 flex items-center justify-center text-slate-400 group-hover:bg-green-500 group-hover:text-white transition">
                            <i class="fas fa-arrow-right text-xs"></i>
                        </div>
                    </div>
                </div>
            </a> -->

        </div>
    </main>

    <footer class="text-center py-10 border-t border-slate-100 mt-10">
        <p class="text-slate-400 text-xs font-bold uppercase tracking-widest">© 2026 MaBagnole Blog System</p>
    </footer>
    <div id="addArticleModal" class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm hidden items-center justify-center z-[100] p-4">
        <div class="bg-white w-full max-w-2xl rounded-[2.5rem] p-10 shadow-2xl max-h-[90vh] overflow-y-auto">
            <div class="flex justify-between items-center mb-8">
                <h3 class="text-3xl font-black text-slate-800">Nouvel Article</h3>
                <button onclick="toggleModal('addArticleModal')" class="text-slate-300 hover:text-slate-600 transition"><i class="fas fa-times text-xl"></i></button>
            </div>

            <form action="process_article.php" method="POST" enctype="multipart/form-data" class="space-y-6">
                <div>
                    <label class="text-[10px] font-black uppercase text-slate-400 tracking-widest block mb-2">Titre de l'article</label>
                    <input type="text" name="titre" required class="w-full p-4 bg-slate-50 border rounded-2xl focus:ring-2 focus:ring-blue-500 outline-none">
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="text-[10px] font-black uppercase text-slate-400 tracking-widest block mb-2">Thème</label>
                        <select name="idTheme" class="w-full p-4 bg-slate-50 border rounded-2xl focus:ring-2 focus:ring-blue-500 outline-none">
                            <option value="1">Voyages</option>
                            <option value="2">Mécanique</option>
                        </select>
                    </div>
                    <div>
                        <label class="text-[10px] font-black uppercase text-slate-400 tracking-widest block mb-2">Tags (séparés par des virgules)</label>
                        <input type="text" name="tags" placeholder="vitesse, sport, été..." class="w-full p-4 bg-slate-50 border rounded-2xl focus:ring-2 focus:ring-blue-500 outline-none">
                    </div>
                </div>

                <div>
                    <label class="text-[10px] font-black uppercase text-slate-400 tracking-widest block mb-2">Contenu</label>
                    <textarea name="contenu" rows="6" class="w-full p-4 bg-slate-50 border rounded-2xl focus:ring-2 focus:ring-blue-500 outline-none"></textarea>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="text-[10px] font-black uppercase text-slate-400 tracking-widest block mb-2">Image / Vidéo (URL)</label>
                        <input type="text" name="media_url" class="w-full p-4 bg-slate-50 border rounded-2xl focus:ring-2 focus:ring-blue-500 outline-none">
                    </div>
                    <div>
                        <label class="text-[10px] font-black uppercase text-slate-400 tracking-widest block mb-2">Ou Upload</label>
                        <input type="file" name="media_file" class="w-full p-3 bg-slate-50 border rounded-2xl outline-none text-xs">
                    </div>
                </div>

                <div class="pt-4">
                    <button type="submit" class="w-full bg-blue-600 text-white py-5 rounded-2xl font-black shadow-lg shadow-blue-100 hover:bg-blue-700 transition">
                        Soumettre pour Approbation
                    </button>
                    <p class="text-center text-[10px] text-slate-400 mt-4 uppercase font-bold tracking-widest">L'article sera vérifié par un administrateur avant publication</p>
                </div>
            </form>
        </div>
    </div>

    <script>
        function toggleModal(id) {
            const modal = document.getElementById(id);
            modal.classList.toggle('hidden');
            modal.classList.toggle('flex');
        }
    </script>
</body>

</html>