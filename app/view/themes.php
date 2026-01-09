<?php

namespace app\view;

require_once __DIR__ . '../../../vendor/autoload.php';

use app\model\Article;
use app\model\Tag;
use app\model\Theme;

session_start();
$connect = true;
if (!isset($_SESSION['Utilisateur']) or  $_SESSION['Utilisateur']->getRole() !== 'client') {
    $connect =  false;
}
$themes = Theme::getAllTheme();
$tags = Tag::getAllTag();

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
            <a href="accueil.php" class="text-sm font-bold text-slate-500 hover:text-blue-600 transition">Explorer les vehicules </a>
            <?php if ($connect): ?>
                <a href="article_favorier" class="text-sm font-bold text-slate-500 hover:text-blue-600 transition">Favoris</a>
            <?php endif; ?>
        </div>
        <div class="flex gap-4 w-full md:w-auto">
            <button type="button" <?php if ($connect): ?> onclick="toggleModal('addArticleModal')" <?php else: ?> onclick="toggleModal('rentPopup')" <?php endif; ?> class="bg-slate-900 text-white px-6 py-4 rounded-2xl font-black hover:bg-blue-600 transition flex items-center gap-2 shadow-lg">
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
                <!-- <div class="relative group">
                    <i class="fas fa-search absolute left-5 top-1/2 -translate-y-1/2 text-slate-400 group-focus-within:text-blue-600 transition"></i>
                    <input type="text" placeholder="Rechercher un titre d'article..."
                        class="w-full pl-14 pr-32 py-5 bg-slate-50 border border-slate-200 rounded-2xl outline-none focus:ring-4 focus:ring-blue-500/10 transition shadow-sm">
                </div> -->
            </form>


        </div>
    </header>

    <main class="max-w-7xl mx-auto px-8 py-16">
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
            <?php foreach ($themes as $theme) : ?>
                <a href="articles.php?id=<?= $theme->getIdTheme() ?>" class="group relative bg-white rounded-[2.5rem] p-8 border border-slate-100 shadow-sm hover:shadow-2xl hover:-translate-y-2 transition-all duration-300 overflow-hidden">
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

        </div>
    </main>

    <footer class="bg-slate-900 text-white pt-20 pb-10">
        <div class="max-w-7xl mx-auto px-4 text-center">
            <span class="text-3xl font-black text-blue-500">MaBagnole</span>
            <p class="text-slate-500 text-sm mt-8">© 2025 MaBagnole Management. All rights reserved.</p>
        </div>
    </footer>
    <div id="addArticleModal" class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm hidden items-center justify-center z-[100] p-4">
        <div class="bg-white w-full max-w-2xl rounded-[2.5rem] p-10 shadow-2xl max-h-[90vh] overflow-y-auto">
            <div class="flex justify-between items-center mb-8">
                <h3 class="text-3xl font-black text-slate-800">Nouvel Article</h3>
                <button type="button" onclick="toggleModal('addArticleModal')" class="text-slate-300 hover:text-slate-600 transition"><i class="fas fa-times text-xl"></i></button>
            </div>

            <form action="../controler/ArticleContoler.php" method="POST" enctype="multipart/form-data" class="space-y-6">
                <div>
                    <label class="text-[10px] font-black uppercase text-slate-400 tracking-widest block mb-2">Titre de l'article</label>
                    <input type="text" name="titreArticle" required class="w-full p-4 bg-slate-50 border rounded-2xl focus:ring-2 focus:ring-blue-500 outline-none">
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="text-[10px] font-black uppercase text-slate-400 tracking-widest block mb-2">Thème</label>
                        <select name="idTheme" class="w-full p-4 bg-slate-50 border rounded-2xl focus:ring-2 focus:ring-blue-500 outline-none">
                            <?php foreach ($themes as $theme) : ?>
                                <option value="<?= $theme->getIdTheme() ?>"><?= $theme->getNomTheme() ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div>
                        <label class="text-[10px] font-black uppercase text-slate-400 tracking-widest block mb-2">Sélectionner des Tags</label>
                        <select id="tagPicker" class="w-full p-4 bg-slate-50 border rounded-2xl focus:ring-2 focus:ring-blue-500 outline-none cursor-pointer">
                            <option value="" disabled selected>Choisir un tag...</option>
                            <?php foreach ($tags as $tag) : ?>
                                <option value="<?= $tag->getIdTag() ?>">#<?= $tag->getNomTag() ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>

                <div id="tagsContainer" class="flex flex-wrap gap-2 min-h-[40px] p-2 bg-slate-100/50 rounded-2xl border border-dashed border-slate-200">
                </div>


                <div>
                    <label class="text-[10px] font-black uppercase text-slate-400 tracking-widest block mb-2">Contenu</label>
                    <textarea name="contenuArticle" rows="6" class="w-full p-4 bg-slate-50 border rounded-2xl focus:ring-2 focus:ring-blue-500 outline-none"></textarea>
                </div>

                <div>
                    <label class="text-[10px] font-black uppercase text-slate-400 tracking-widest block mb-2">Image / Vidéo (URL)</label>
                    <input type="link" name="media_url" class="w-full p-4 bg-slate-50 border rounded-2xl focus:ring-2 focus:ring-blue-500 outline-none">
                </div>

                <input type="hidden" name="action" value="add">

                <div class="pt-4">
                    <button type="submit" class="w-full bg-blue-600 text-white py-5 rounded-2xl font-black shadow-lg shadow-blue-100 hover:bg-blue-700 transition">
                        Soumettre pour Approbation
                    </button>
                </div>
            </form>


        </div>
    </div>
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
    <script>
        const tagPicker = document.getElementById('tagPicker');
        const tagsContainer = document.getElementById('tagsContainer');
        const finalTagsInput = document.getElementById('finalTags');
        let selectedTags = [];
        tagPicker.addEventListener('change', function() {
            const tagValue = this.value;
            const tagText = this.options[this.selectedIndex].text;
            if (tagValue && !selectedTags.includes(tagValue)) {
                selectedTags.push(tagValue);
                addTagToUI(tagValue, tagText);
                updateHiddenInput();
            }
            this.value = "";
        });

        function addTagToUI(value, text) {
            const tagDiv = document.createElement('div');
            tagDiv.className = "flex items-center gap-2 bg-blue-600 text-white text-[10px] font-black px-3 py-2 rounded-xl animate-in fade-in zoom-in duration-200";
            tagDiv.innerHTML = `
                        <span>${text}</span>
                        <input type="hidden" name="tags[]" value="${value}"> <button type="button" onclick="removeTag('${value}', this)" class="hover:text-red-300 transition">
                            <i class="fas fa-times"></i>
                        </button>
                    `;
            tagsContainer.appendChild(tagDiv);
        }

        function removeTag(value, element) {
            selectedTags = selectedTags.filter(tag => tag !== value);
            element.parentElement.remove();
            updateHiddenInput();
        }

        function updateHiddenInput() {
            finalTagsInput.value = selectedTags.join(',');
        }
    </script>
    <script>
        function toggleModal(id) {
            const modal = document.getElementById(id);
            modal.classList.toggle('hidden');
            modal.classList.toggle('flex');
        }
    </script>
</body>

</html>