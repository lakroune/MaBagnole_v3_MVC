<?php

namespace app\view;

use app\model\Article;
use app\model\Client;

require_once __DIR__ . '/../../vendor/autoload.php';

session_start();

if (!isset($_SESSION['Utilisateur']) || $_SESSION['Utilisateur']->getRole() !== 'admin') {
    header('Location: login.php');
    exit();
}

$auteur = new Client();

$articlesList = Article::getAllArticlesNonApprouve();

?>


<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MaBagnole Admin | Gestion Articles</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;800&display=swap');

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            overflow: hidden;
        }

        .modal-animate {
            animation: zoomIn 0.3s ease-out;
        }

        @keyframes zoomIn {
            from {
                opacity: 0;
                transform: scale(0.95);
            }

            to {
                opacity: 1;
                transform: scale(1);
            }
        }
    </style>
</head>

<body class="bg-slate-50 flex h-screen">

    <?php include "sidebar.php"; ?>

    <div class="flex-1 flex flex-col h-screen overflow-y-auto">


        <main class="p-8">
            <div class="mb-10">
                <h1 class="text-3xl font-black text-slate-900">Articles en <span class="text-blue-600">Attente</span></h1>
                <p class="text-slate-500 text-sm mt-1">Examinez les publications avant leur mise en ligne.</p>
            </div>

            <div class="space-y-4">
                <table>
                    <thead>
                        <tr class="text-left text-slate-600 border-b border-slate-200 pb-4">

                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($articlesList as $article) : ?>
                            <div id="art-1" class="bg-white p-5 rounded-[2rem] border border-slate-100 flex flex-col lg:flex-row items-center justify-between gap-6 hover:shadow-xl transition-all duration-300">
                                <div class="flex items-center gap-6">
                                    <img src="https://images.unsplash.com/photo-1503376780353-7e6692767b70?w=1200" class="w-24 h-20 rounded-2xl object-cover shadow-inner">
                                    <div>
                                        <span class="bg-amber-100 text-amber-600 text-[9px] font-black uppercase px-2 py-0.5 rounded">Pending</span>
                                        <h3 class="font-black text-slate-800 text-lg mt-1 leading-tight"><?php echo $article->getTitreArticle() ?>!</h3>
                                        <p class="text-[10px] text-slate-400 font-bold uppercase mt-1">Auteur:
                                            <?php
                                            // $auteur = ($auteur->getClientById($article->getIdAuteur()));
                                            // echo $auteur;

                                            ?> • Il y a
                                            <?php
                                            $toDay = new \DateTime();
                                            $articleDate = new \DateTime($article->getDatePublicationArticle());
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
                                            ?>


                                        </p>
                                    </div>
                                </div>
                                <div class="flex gap-2">
                                    <button onclick="confirmAction('approve', <?php echo $article->getIdArticle() ?>, '<?php echo $article->getTitreArticle() ?>')" class="bg-green-500 text-white px-6 py-3 rounded-xl font-black text-xs hover:bg-green-600 transition shadow-lg shadow-green-100 flex items-center gap-2">
                                        <i class="fas fa-check"></i> Approuver
                                    </button>
                                    <button onclick="confirmAction('delete', <?php echo $article->getIdArticle() ?>, '<?php echo $article->getTitreArticle() ?>')" class="w-12 h-12 bg-slate-50 text-slate-400 rounded-xl hover:bg-red-500 hover:text-white transition flex items-center justify-center shadow-sm">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </div>
                            </div>
                        <?php endforeach; ?>
                </table>
            </div>
        </main>
    </div>

    <div id="actionModal" class="fixed inset-0 bg-slate-900/80 backdrop-blur-md hidden items-center justify-center z-[200] p-4">
        <div class="bg-white w-full max-w-sm rounded-[3rem] p-10 shadow-2xl text-center modal-animate">
            <form action="../controler/ArticleContoler.php" method="POST">
                <div id="modalIconContainer" class="w-20 h-20 rounded-full flex items-center justify-center mx-auto mb-6 text-2xl animate-bounce">
                    <i id="modalIcon" class="fas"></i>
                </div>
                <h3 id="modalTitle" class="text-2xl font-black text-slate-800 mb-2">Confirmation</h3>
                <p id="modalMsg" class="text-slate-500 text-sm mb-8 leading-relaxed"></p>
                <input type="hidden" name="action" id="action">
                <input type="hidden" name="idArticle" id="idArticle">
                <div class="flex gap-3">
                    <button type="button" onclick="closeActionModal()" class="flex-1 py-4 font-bold text-slate-400 bg-slate-50 rounded-2xl hover:bg-slate-100 transition">Annuler</button>
                    <button id="confirmBtn" class="flex-1 py-4 text-white rounded-2xl font-black shadow-lg transition transform hover:scale-105 active:scale-95">Confirmer</button>
                </div>
            </form>
        </div>
    </div>



    <script>
        function confirmAction(type, id, title) {
            const modal = document.getElementById('actionModal');
            const iconCont = document.getElementById('modalIconContainer');
            const icon = document.getElementById('modalIcon');
            const btn = document.getElementById('confirmBtn');
            const titleEl = document.getElementById('modalTitle');
            const msgEl = document.getElementById('modalMsg');
            const action = document.getElementById('action');
            document.getElementById('idArticle').value = id;

            if (type === 'approve') {
                iconCont.className = "w-20 h-20 bg-green-50 text-green-500 rounded-full flex items-center justify-center mx-auto mb-6 text-2xl shadow-inner";
                icon.className = "fas fa-check-circle";
                btn.className = "flex-1 py-4 bg-green-500 text-white rounded-2xl font-black shadow-lg shadow-green-100";
                titleEl.innerText = "Publier l'article ?";
                msgEl.innerText = `Souhaitez-vous approuver et publier l'article "${title}" ?`;
                action.value = 'approve';
            } else {
                iconCont.className = "w-20 h-20 bg-red-50 text-red-500 rounded-full flex items-center justify-center mx-auto mb-6 text-2xl shadow-inner";
                icon.className = "fas fa-exclamation-triangle";
                btn.className = "flex-1 py-4 bg-red-500 text-white rounded-2xl font-black shadow-lg shadow-red-100";
                titleEl.innerText = "Supprimer ?";
                msgEl.innerText = `Êtes-vous sûr de vouloir supprimer définitivement "${title}" ?`;
                action.value = 'delete';
            }
            modal.classList.remove('hidden');
            modal.classList.add('flex');
        }

        function closeActionModal() {
            document.getElementById('actionModal').classList.add('hidden');
            document.getElementById('actionModal').classList.remove('flex');
        }
    </script>
</body>

</html>