<?php

namespace app\view;

use app\model\Tag;

require_once __DIR__ . '/../../vendor/autoload.php';

$tags = Tag::getAllTag();
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MaBagnole Admin | Gestion des Tags</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        @keyframes slideIn {
            from {
                transform: translateX(100%);
                opacity: 0;
            }

            to {
                transform: translateX(0);
                opacity: 1;
            }
        }

        .animate-toast {
            animation: slideIn 0.3s ease-out forwards;
        }
    </style>
</head>

<body class="bg-slate-50 min-h-screen flex">

    <?php include "sidebar.php" ?>

    <main class="flex-1 p-8">
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 mb-10">
            <div>
                <h1 class="text-3xl font-black text-slate-800">Gestion des <span class="text-blue-600">Tags</span></h1>
                <p class="text-slate-500 font-medium">Organisez les mots-clés pour faciliter la recherche des articles.</p>
            </div>

            <button onclick="openBulkTagsModal()" class="bg-slate-900 text-white px-6 py-3 rounded-2xl font-black hover:bg-blue-600 transition shadow-lg flex items-center gap-2">
                <i class="fas fa-plus-circle"></i> Ajouter Plusieurs Tags
            </button>
        </div>

        <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-4">
            <?php foreach ($tags as $tag) : ?>
                <div id="tag-<?= $tag->getIdTag() ?>" class="bg-white p-4 rounded-2xl border border-slate-100 shadow-sm flex items-center justify-between group hover:border-blue-500 transition">
                    <span class="font-bold text-slate-700">#<?= htmlspecialchars($tag->getNomTag()) ?></span>
                    <button onclick="confirmDeleteTag(<?= $tag->getIdTag() ?>, '<?= addslashes($tag->getNomTag()) ?>')"
                        class="text-slate-300 hover:text-red-500 transition opacity-0 group-hover:opacity-100">
                        <i class="fas fa-times-circle"></i>
                    </button>
                </div>
            <?php endforeach; ?>
        </div>
    </main>

    <div id="bulkTagsModal" class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm hidden items-center justify-center z-[110] p-4">
        <div class="bg-white w-full max-w-md rounded-[2.5rem] p-8 shadow-2xl">
            <div class="flex justify-between items-center mb-6">
                <h3 class="text-2xl font-black text-slate-800">Nouveaux Tags</h3>
                <button onclick="closeBulkTagsModal()" class="text-slate-300 hover:text-slate-600"><i class="fas fa-times"></i></button>
            </div>

            <p class="text-xs text-slate-400 font-bold uppercase mb-4 tracking-widest">Séparez les tags par des virgules</p>

            <form action="../controler/TagControler.php" method="POST">
                <textarea name="nomTag" rows="4" placeholder="Ex: Luxe, Sport, Voyage, Entretien..."
                    class="w-full p-4 bg-slate-50 border border-slate-100 rounded-2xl focus:ring-2 focus:ring-blue-500 outline-none text-sm mb-6"></textarea>

                <div class="flex gap-3">
                    <button type="button" onclick="closeBulkTagsModal()" class="flex-1 py-4 font-bold text-slate-400 bg-slate-50 rounded-2xl">Annuler</button>
                    <button type="submit" class="flex-1 py-4 bg-blue-600 text-white rounded-2xl font-black shadow-lg hover:bg-blue-700 transition">
                        Enregistrer
                    </button>
                </div>
            </form>
        </div>
    </div>

    <div id="confirmModal" class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm hidden items-center justify-center z-[120] p-4">
        <div class="bg-white w-full max-w-sm rounded-[2.5rem] p-8 shadow-2xl text-center">
            <div class="w-20 h-20 bg-red-100 text-red-600 rounded-full flex items-center justify-center mx-auto mb-6 text-3xl">
                <i class="fas fa-trash-alt"></i>
            </div>
            <h3 class="text-2xl font-black text-slate-800 mb-2">Supprimer ?</h3>
            <p id="confirmMessage" class="text-slate-500 font-medium mb-8 text-sm italic"></p>

            <form action="../controler/TagControler.php" method="POST">
                <input type="hidden" name="idTag" id="tagIdToDelete" value="">
                <input type="hidden" name="action" value="delete">
                <div class="flex gap-3 justify-center">
                    <button type="button" onclick="closeConfirmModal()" class="flex-1 py-4 font-bold text-slate-400 bg-slate-50 rounded-2xl">Annuler</button>
                    <button id="btnConfirmDelete" type="button" class="flex-1 py-4 bg-red-500 text-white rounded-2xl font-black shadow-lg hover:bg-red-600 transition">
                        Supprimer
                    </button>
                </div>
            </form>
        </div>
    </div>

    <div id="toastContainer" class="fixed bottom-5 right-5 z-[150] flex flex-col gap-3"></div>

    <script>
        function openBulkTagsModal() {
            document.getElementById('bulkTagsModal').classList.replace('hidden', 'flex');
        }

        function closeBulkTagsModal() {
            document.getElementById('bulkTagsModal').classList.replace('flex', 'hidden');
        }

        let tagToDelete = null;

        function confirmDeleteTag(id, name) {
            tagToDelete = id;
            const modal = document.getElementById('confirmModal');
            document.getElementById('confirmMessage').innerText = `Êtes-vous sûr de vouloir supprimer le tag #${name} ?`;
            modal.classList.replace('hidden', 'flex');
            document.getElementById('tagIdToDelete').value = id;
            document.getElementById('btnConfirmDelete').onclick = function() {
                executeDeletion(id, name);
            };
        }

        function closeConfirmModal() {
            document.getElementById('confirmModal').classList.replace('flex', 'hidden');
        }

        function executeDeletion(id, name) {
            const element = document.getElementById('tag-' + id);
            if (element) {
                element.style.opacity = '0';
                setTimeout(() => {
                    element.remove();
                    showToast(`Le tag #${name} a été supprimé.`, 'success');
                }, 300);
            }
            closeConfirmModal();
        }

        function showToast(message, type = 'success') {
            const container = document.getElementById('toastContainer');
            const toast = document.createElement('div');

            const bgColor = type === 'success' ? 'bg-emerald-500' : 'bg-red-500';
            const icon = type === 'success' ? 'fa-check-circle' : 'fa-exclamation-circle';

            toast.className = `${bgColor} text-white px-6 py-4 rounded-2xl shadow-xl flex items-center gap-3 animate-toast`;
            toast.innerHTML = `
                <i class="fas ${icon}"></i>
                <span class="font-bold text-sm">${message}</span>
            `;

            container.appendChild(toast);

            setTimeout(() => {
                toast.style.opacity = '0';
                toast.style.transition = '0.5s';
                setTimeout(() => toast.remove(), 500);
            }, 4000);
        }
    </script>
</body>

</html>