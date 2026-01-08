<?php

namespace app\view;

use app\model\Article;
use app\model\Client;

require_once __DIR__ . '/../../vendor/autoload.php';



$auteur = new Client();

$articlesList = Article::getAllArticles();

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
                <?php foreach ($articlesList as $article) : ?>
                    <div id="art-1" class="bg-white p-5 rounded-[2rem] border border-slate-100 flex flex-col lg:flex-row items-center justify-between gap-6 hover:shadow-xl transition-all duration-300">
                        <div class="flex items-center gap-6">
                            <img src="https://images.unsplash.com/photo-1542362567-b055002b91f4?w=400" class="w-24 h-20 rounded-2xl object-cover shadow-inner">
                            <div>
                                <span class="bg-amber-100 text-amber-600 text-[9px] font-black uppercase px-2 py-0.5 rounded">Pending</span>
                                <h3 class="font-black text-slate-800 text-lg mt-1 leading-tight"><?php echo $article->getTitreArticle() ?>!</h3>
                                <p class="text-[10px] text-slate-400 font-bold uppercase mt-1">Auteur:
                                    <?php $auteur = ($auteur->getClientById($article->getIdAuteur()));
                                    echo $auteur;

                                    ?> • Il y a 45 min</p>
                            </div>
                        </div>
                        <div class="flex gap-2">
                            <button onclick="confirmAction('approve', 1, 'L\'impact des moteurs hybrides...')" class="bg-green-500 text-white px-6 py-3 rounded-xl font-black text-xs hover:bg-green-600 transition shadow-lg shadow-green-100 flex items-center gap-2">
                                <i class="fas fa-check"></i> Approuver
                            </button>
                            <button onclick="confirmAction('delete', 1, 'L\'impact des moteurs hybrides...')" class="w-12 h-12 bg-slate-50 text-slate-400 rounded-xl hover:bg-red-500 hover:text-white transition flex items-center justify-center shadow-sm">
                                <i class="fas fa-trash-alt"></i>
                            </button>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </main>
    </div>

    <div id="actionModal" class="fixed inset-0 bg-slate-900/80 backdrop-blur-md hidden items-center justify-center z-[200] p-4">
        <div class="bg-white w-full max-w-sm rounded-[3rem] p-10 shadow-2xl text-center modal-animate">
            <div id="modalIconContainer" class="w-20 h-20 rounded-full flex items-center justify-center mx-auto mb-6 text-2xl animate-bounce">
                <i id="modalIcon" class="fas"></i>
            </div>
            <h3 id="modalTitle" class="text-2xl font-black text-slate-800 mb-2">Confirmation</h3>
            <p id="modalMsg" class="text-slate-500 text-sm mb-8 leading-relaxed"></p>
            <div class="flex gap-3">
                <button onclick="closeActionModal()" class="flex-1 py-4 font-bold text-slate-400 bg-slate-50 rounded-2xl hover:bg-slate-100 transition">Annuler</button>
                <button id="confirmBtn" class="flex-1 py-4 text-white rounded-2xl font-black shadow-lg transition transform hover:scale-105 active:scale-95">Confirmer</button>
            </div>
        </div>
    </div>

    <div id="toast" class="fixed bottom-10 right-10 z-[210] transform translate-y-32 opacity-0 transition-all duration-500">
        <div class="bg-slate-900 text-white px-8 py-5 rounded-[1.5rem] shadow-2xl flex items-center gap-4 border border-slate-700">
            <div class="w-8 h-8 rounded-full bg-green-500 flex items-center justify-center text-[10px] shadow-lg shadow-green-500/30">
                <i class="fas fa-check"></i>
            </div>
            <div>
                <p class="font-black text-xs uppercase tracking-widest text-slate-400">Notification</p>
                <p id="toastMsg" class="font-bold text-sm"></p>
            </div>
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

            if (type === 'approve') {
                iconCont.className = "w-20 h-20 bg-green-50 text-green-500 rounded-full flex items-center justify-center mx-auto mb-6 text-2xl shadow-inner";
                icon.className = "fas fa-check-circle";
                btn.className = "flex-1 py-4 bg-green-500 text-white rounded-2xl font-black shadow-lg shadow-green-100";
                titleEl.innerText = "Publier l'article ?";
                msgEl.innerText = `Souhaitez-vous approuver et publier l'article "${title}" ?`;
                btn.onclick = () => processAction(id, "publié");
            } else {
                iconCont.className = "w-20 h-20 bg-red-50 text-red-500 rounded-full flex items-center justify-center mx-auto mb-6 text-2xl shadow-inner";
                icon.className = "fas fa-exclamation-triangle";
                btn.className = "flex-1 py-4 bg-red-500 text-white rounded-2xl font-black shadow-lg shadow-red-100";
                titleEl.innerText = "Supprimer ?";
                msgEl.innerText = `Êtes-vous sûr de vouloir supprimer définitivement "${title}" ?`;
                btn.onclick = () => processAction(id, "supprimé");
            }

            modal.classList.remove('hidden');
            modal.classList.add('flex');
        }

        function closeActionModal() {
            document.getElementById('actionModal').classList.add('hidden');
            document.getElementById('actionModal').classList.remove('flex');
        }

        function processAction(id, actionText) {
            closeActionModal();
            // Simulate removal/update
            const row = document.getElementById('art-' + id);
            row.style.opacity = '0';
            row.style.transform = 'translateX(20px)';
            setTimeout(() => {
                row.remove();
                showToast(`L'article a été ${actionText} avec succès !`);
            }, 500);
        }

        function showToast(msg) {
            const t = document.getElementById('toast');
            document.getElementById('toastMsg').innerText = msg;
            t.classList.remove('translate-y-32', 'opacity-0');
            t.classList.add('translate-y-0', 'opacity-100');
            setTimeout(() => {
                t.classList.add('translate-y-32', 'opacity-0');
            }, 3000);
        }
    </script>
</body>

</html>