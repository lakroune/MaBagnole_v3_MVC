<?php

namespace app\view;

require_once __DIR__ . '/../../vendor/autoload.php';

use app\model\Theme;
use app\model\Article;
use app\model\Client;
use app\model\Commentaire;
use app\model\Tag;
use DateTime;
use Exception;

session_start();
$connect = true;
if (!isset($_SESSION['Utilisateur']) or  $_SESSION['Utilisateur']->getRole() !== 'client') {
    $connect =  false;
}
if (!isset($_GET['id']) || empty($_GET['id'])) {
    header("Location: themes.php");
    exit();
}

try {
    $idArticle = (int)($_GET['id']);
    $listCommentaire = Commentaire::getCommentairesByArticle($idArticle);
    $article = new Article();
    $theme = new Theme();
    $auteur = new Client;
    $tag = new Tag();
    $tagsList = $tag->getTagsByArticle($idArticle);
    $article = $article->getArticleById($idArticle);
    $theme = $theme->getThemeById($article->getIdTheme());
    $auteur = $auteur->getClientById($article->getIdAuteur());
} catch (\Exception $e) {
    // header("Location: themes_list.php");
    echo $e->getMessage();
    exit();
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MaBagnole | Lecture Article</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>

<body class="bg-slate-50 min-h-screen">

    <nav class="bg-white border-b border-slate-100 px-8 py-4 sticky top-0 z-50">
        <div class="max-w-5xl mx-auto flex justify-between items-center">
            <a href="articles_list.php" class="text-sm font-bold text-slate-400 hover:text-blue-600 transition flex items-center gap-2">
                <i class="fas fa-chevron-left"></i> Retour aux articles
            </a>
            <div class="text-xl font-black text-blue-600">Ma<span class="text-slate-800">Bagnole</span></div>
            <button type="button" <?php if (!$connect) : ?> onclick="toggleModal('rentPopup')" <?php else:; ?> onclick="toggleFavorite(this)" <?php endif; ?> class="w-10 h-10 bg-slate-50 rounded-full flex items-center justify-center text-slate-400 hover:text-red-500 transition">
                <i class="fas fa-heart"></i>
            </button>
        </div>
    </nav>

    <main class="max-w-4xl mx-auto px-6 py-12">
        <article class="bg-white rounded-[3rem] shadow-sm border border-slate-100 overflow-hidden">
            <div class="h-[450px] relative">
                <img src="https://images.unsplash.com/photo-1503376780353-7e6692767b70?w=1200" class="w-full h-full object-cover">
                <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>
                <div class="absolute bottom-10 left-10">
                    <span class="bg-blue-600 text-white px-4 py-1 rounded-full text-[10px] font-black uppercase tracking-widest mb-4 inline-block">Thème :<?= $theme->getNomTheme() ?> </span>
                    <h1 class="text-4xl font-black text-white leading-tight"><?= $article->getTitreArticle() ?></h1>
                </div>
            </div>

            <div class="p-10 md:p-16">
                <div class="flex items-center justify-between mb-10 pb-6 border-b border-slate-50">
                    <div class="flex items-center gap-4">
                        <img src="https://i.pravatar.cc/100?u=author" class="w-12 h-12 rounded-2xl border-2 border-white shadow-sm">
                        <div>
                            <p class="text-sm font-black text-slate-800"><?= "" // $auteur->getNomUtilisateur().' '.$auteur->getPrenomUtilisateur() 
                                                                            ?></p>
                            <p class="text-[10px] text-slate-400 font-bold uppercase">Publié le 05 Janvier 2026</p>
                        </div>
                    </div>
                    <div class="flex gap-2">
                        <?php foreach ($tagsList as $tag) : ?>
                            <span class="text-[10px] font-bold text-blue-600 bg-blue-50 px-3 py-1 rounded-lg">#Luxe</span>
                        <?php endforeach; ?>
                        <!-- <span class="text-[10px] font-bold text-slate-400 bg-slate-50 px-3 py-1 rounded-lg">#Performance</span> -->
                    </div>
                </div>

                <div class="prose prose-slate max-w-none text-slate-600 text-lg leading-relaxed">
                    <p class="mb-6 font-bold text-slate-800"><?= $article->getContenuArticle() ?></p>
                    <!-- <p class="mb-6">Depuis son introduction en 1963, elle a su conserver son ADN tout en intégrant les technologies les plus modernes. Louer une 911 chez <strong>MaBagnole</strong>, c'est toucher du doigt une légende mécanique...</p> -->
                </div>
            </div>
        </article>

        <section class="mt-16">
            <h3 class="text-2xl font-black text-slate-800 mb-8 flex items-center gap-3">
                <i class="far fa-comments text-blue-600"></i> Discussions (3)
            </h3>

            <div class="bg-white p-8 rounded-[2.5rem] shadow-sm border border-slate-100 mb-12">
                <div class="flex gap-4">
                    <form action="../controler/CommentairesControler.php" method="POST" class="flex-1">
                        <input type="hidden" name="idArticle" value="<?= $article->getIdArticle() ?>">
                        <input type="hidden" name="page" value="article_detail">
                        <input type="hidden" name="action" value="add">
                        <div class="flex-1">
                            <textarea id="commentText" name="contenuCommentaire" placeholder="Partagez votre avis sur cet article..."
                                class="w-full p-5 bg-slate-50 border-none rounded-2xl focus:ring-2 focus:ring-blue-500 outline-none text-sm min-h-[120px] transition"></textarea>
                            <div class="flex justify-end mt-4">
                                <button onclick="handleComment()" class="bg-slate-900 text-white px-8 py-3 rounded-xl font-black text-sm hover:bg-blue-600 transition shadow-lg">
                                    Envoyer
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <div class="space-y-6">
                <?php foreach ($listCommentaire as $commentaire) : ?>
                    <div class="bg-white p-8 rounded-[2.5rem] border border-slate-100 relative group transition hover:border-blue-200">
                        <div class="flex gap-4">
                            <img src="https://i.pravatar.cc/100?u=me" class="w-12 h-12 rounded-2xl">
                            <div class="flex-1">
                                <div class="flex justify-between items-center mb-2">
                                    <h4 class="font-black text-slate-800 text-sm">
                                        <?php
                                        try {
                                            $client = new Client();
                                            $client = $client->getClientById($commentaire->getIdClient());

                                            if ($client->getIdUtilisateur() == $commentaire->getIdClient())
                                                echo "Vous";
                                            else
                                                echo $client->getNomUtilisateur() . ' ' . $client->getPrenomUtilisateur();
                                        } catch (Exception $e) {
                                            error_log(date('y-m-d h:i:s') . " Connexion :error ." . $e . PHP_EOL, 3, "error.log");
                                        }
                                        ?> <span class="text-[10px] text-blue-500 ml-2 font-bold uppercase">Auteur</span></h4>
                                    <div class="flex gap-3 opacity-0 group-hover:opacity-100 transition-opacity">
                                        <button onclick="editComment(this)" class="text-[10px] font-black text-blue-600 uppercase hover:underline">Modifier</button>
                                        <button onclick="deleteAction()" class="text-[10px] font-black text-red-500 uppercase hover:underline">Supprimer</button>
                                    </div>
                                </div>
                                <p class="text-slate-500 text-sm leading-relaxed"><?= $commentaire->getTextCommentaire() ?></p>
                                <p class="text-[10px] text-slate-300 font-bold mt-4">
                                    <?php

                                    $toDay = new DateTime();
                                    $commentaireDate = new DateTime($commentaire->getDateCommentaire());
                                    $interval = $toDay->diff($commentaireDate);
                                    if ($interval->d > 0) {
                                        echo $interval->d . ' jours';
                                    } elseif ($interval->h > 0) {
                                        echo $interval->h . ' heures';
                                    } elseif ($interval->i > 0) {
                                        echo $interval->i . ' minutes';
                                    } else {
                                        echo "À l\'instant";
                                    }
                                    ?></p>
                            </div>
                        </div>
                    </div>

                <?php endforeach; ?>
            </div>
        </section>
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


    <script>
        function toggleModal(id) {
            const modal = document.getElementById(id);
            modal.classList.toggle('hidden');
            modal.classList.toggle('flex');
        }

        function toggleFavorite(btn) {
            btn.classList.toggle('text-red-500');
            btn.classList.toggle('text-slate-400');

        }
    </script>

</body>

</html>