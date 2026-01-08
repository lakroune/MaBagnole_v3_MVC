<?php

namespace app\view;

use app\model\Theme;

require_once __DIR__ . '/../../vendor/autoload.php';




$themes = new Theme();
$themesList = Theme::getAllTheme();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MaBagnole Admin | Gestion des Thèmes</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>

<body class="bg-slate-50 min-h-screen flex">

    <?php include 'sidebar.php'; ?>

    <main class="max-w-7xl mx-auto px-8 py-12">
        <div class="flex flex-col md:flex-row justify-between items-end mb-12 gap-6">
            <div>
                <h1 class="text-4xl font-black text-slate-900 mb-2">Gestion des <span class="text-blue-600">Thèmes</span></h1>
                <p class="text-slate-500 font-medium">Créez, modifiez et organisez les catégories de votre blog automobile.</p>
            </div>
            <button onclick="openAddModal()" class="bg-slate-900 text-white px-8 py-4 rounded-[1.5rem] font-black shadow-xl shadow-slate-200 hover:bg-blue-600 transition-all flex items-center gap-3">
                <i class="fas fa-plus"></i> Nouveau Thème
            </button>
        </div>

        <div class="bg-white rounded-[2.5rem] shadow-sm border border-slate-100 overflow-hidden">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-slate-50/50 border-b border-slate-100">
                        <th class="p-8 text-[11px] font-black uppercase text-slate-400 tracking-widest">Thème info</th>
                        <th class="p-8 text-[11px] font-black uppercase text-slate-400 tracking-widest">Description</th>
                        <th class="p-8 text-[11px] font-black uppercase text-slate-400 tracking-widest">Articles</th>
                        <th class="p-8 text-[11px] font-black uppercase text-slate-400 tracking-widest text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-50">
                    <?php foreach ($themesList as $theme) : ?>
                        <tr class="hover:bg-slate-50/50 transition group">
                            <td class="p-8">
                                <div class="flex items-center gap-4">
                                    <div class="w-14 h-14 bg-blue-50 text-blue-600 rounded-2xl flex items-center justify-center text-xl shadow-inner">
                                        <i class="fas fa-car"></i>
                                    </div>
                                    <div>
                                        <span class="font-black text-slate-800 block">Entretien Auto</span>
                                        <span class="text-[10px] text-slate-400 font-bold uppercase tracking-tight">ID: #0122</span>
                                    </div>
                                </div>
                            </td>
                            <td class="p-8">
                                <p class="text-sm text-slate-500 max-w-xs leading-relaxed">Conseils pratiques pour maintenir votre moteur en parfait état.</p>
                            </td>
                            <td class="p-8">
                                <span class="bg-slate-100 text-slate-600 px-4 py-1.5 rounded-full text-xs font-black">24</span>
                            </td>
                            <td class="p-8">
                                <div class="flex justify-end gap-3">
                                    <button onclick="openEditModal(1, 'Entretien Auto', 'Conseils pratiques...')" class="w-11 h-11 bg-slate-50 text-slate-400 rounded-xl hover:bg-blue-600 hover:text-white transition shadow-sm">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button onclick="handleDelete(1, 'Entretien Auto')" class="w-11 h-11 bg-slate-50 text-slate-400 rounded-xl hover:bg-red-500 hover:text-white transition shadow-sm">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </main>

    <div id="themeModal" class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm hidden items-center justify-center z-[150] p-4">
        <div class="bg-white w-full max-w-lg rounded-[3rem] p-10 shadow-2xl scale-95 animate-in zoom-in duration-300">
            <h3 id="modalTitle" class="text-3xl font-black text-slate-800 mb-8">Ajouter Thème</h3>

            <form id="themeForm" action="../controler/ThemeControler.php" method="POST" class="space-y-6">
                <input type="hidden" id="themeId">
                <div>
                    <label class="text-[10px] font-black uppercase text-slate-400 tracking-widest block mb-2 ml-2">Nom du Thème</label>
                    <input type="text" id="themeName" name="nomTheme" required class="w-full p-5 bg-slate-50 border-none rounded-2xl outline-none focus:ring-4 focus:ring-blue-500/10 transition">
                </div>
                <div>
                    <label class="text-[10px] font-black uppercase text-slate-400 tracking-widest block mb-2 ml-2">Description</label>
                    <textarea name="descriptionTheme" id="themeDesc" rows="4" class="w-full p-5 bg-slate-50 border-none rounded-2xl outline-none focus:ring-4 focus:ring-blue-500/10 transition"></textarea>
                </div>

                <div class="flex gap-4 pt-4">
                    <button type="button" onclick="closeModal('themeModal')" class="flex-1 py-5 font-bold text-slate-400 bg-slate-100 rounded-2xl hover:bg-slate-200 transition">Annuler</button>
                    <button type="submit" class="flex-1 py-5 bg-blue-600 text-white rounded-2xl font-black shadow-xl shadow-blue-200 hover:bg-blue-700 transition">Confirmer</button>
                </div>
            </form>
        </div>
    </div>

    <div id="toast" class="fixed bottom-10 left-1/2 -translate-x-1/2 z-[200] transform translate-y-32 opacity-0 transition-all duration-500">
        <div class="bg-slate-900 text-white px-8 py-4 rounded-2xl shadow-2xl flex items-center gap-4">
            <div id="toastIcon" class="w-8 h-8 rounded-full bg-green-500 flex items-center justify-center text-xs">
                <i class="fas fa-check"></i>
            </div>
            <p id="toastMsg" class="font-bold text-sm"></p>
        </div>
    </div>

    <div id="actionModal" class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm hidden items-center justify-center z-[200] p-4">
        <div class="bg-white w-full max-w-sm rounded-[2.5rem] p-10 shadow-2xl text-center">
            <div id="actionIconBg" class="w-20 h-20 rounded-full flex items-center justify-center mx-auto mb-6 text-2xl">
                <i id="actionIcon" class="fas"></i>
            </div>
            <h3 id="actionTitle" class="text-2xl font-black text-slate-800 mb-2">Confirmation</h3>
            <p id="actionMsg" class="text-slate-500 text-sm mb-8 leading-relaxed"></p>
            <div class="flex gap-3">
                <button onclick="closeModal('actionModal')" class="flex-1 py-4 font-bold text-slate-400 bg-slate-50 rounded-xl">Non</button>
                <button id="confirmActionBtn" class="flex-1 py-4 text-white rounded-xl font-black shadow-lg">Oui, continuer</button>
            </div>
        </div>
    </div>

    <script>
        function openAddModal() {
            document.getElementById('modalTitle').innerText = "Nouveau Thème";
            document.getElementById('themeForm').reset();
            document.getElementById('themeId').value = "";
            showModal('themeModal');
        }

        function openEditModal(id, name, desc) {
            document.getElementById('modalTitle').innerText = "Modifier Thème";
            document.getElementById('themeId').value = id;
            document.getElementById('themeName').value = name;
            document.getElementById('themeDesc').value = desc;
            showModal('themeModal');
        }

        function showModal(id) {
            const m = document.getElementById(id);
            m.classList.remove('hidden');
            m.classList.add('flex');
        }

        function closeModal(id) {
            const m = document.getElementById(id);
            m.classList.add('hidden');
            m.classList.remove('flex');
        }

        function handleDelete(id, name) {
            const iconBg = document.getElementById('actionIconBg');
            const icon = document.getElementById('actionIcon');
            const btn = document.getElementById('confirmActionBtn');

            iconBg.className = "w-20 h-20 bg-red-50 text-red-500 rounded-full flex items-center justify-center mx-auto mb-6 text-2xl";
            icon.className = "fas fa-trash-alt";
            btn.className = "flex-1 py-4 bg-red-500 text-white rounded-xl font-black shadow-lg";

            document.getElementById('actionTitle').innerText = "Supprimer ?";
            document.getElementById('actionMsg').innerText = `Voulez-vous vraiment supprimer le thème "${name}" ?`;

            btn.onclick = () => {
                console.log("Delete triggered for ID:", id);
                closeModal('actionModal');
                showToast("Thème supprimé avec succès", "success");
            };

            showModal('actionModal');
        }
    </script>
</body>

</html>









<!-- 

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MaBagnole Admin | Gestion des Thèmes</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>

<body class="bg-slate-50 min-h-screen flex">

    <?php include 'sidebar.php'; ?>

    <main class="max-w-7xl mx-auto px-8 py-12">
        <div class="flex flex-col md:flex-row justify-between items-end mb-12 gap-6">
            <div>
                <h1 class="text-4xl font-black text-slate-900 mb-2">Gestion des <span class="text-blue-600">Thèmes</span></h1>
                <p class="text-slate-500 font-medium">Créez, modifiez et organisez les catégories de votre blog automobile.</p>
            </div>
            <button onclick="openAddModal()" class="bg-slate-900 text-white px-8 py-4 rounded-[1.5rem] font-black shadow-xl shadow-slate-200 hover:bg-blue-600 transition-all flex items-center gap-3">
                <i class="fas fa-plus"></i> Nouveau Thème
            </button>
        </div>

        <div class="bg-white rounded-[2.5rem] shadow-sm border border-slate-100 overflow-hidden">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-slate-50/50 border-b border-slate-100">
                        <th class="p-8 text-[11px] font-black uppercase text-slate-400 tracking-widest">Thème info</th>
                        <th class="p-8 text-[11px] font-black uppercase text-slate-400 tracking-widest">Description</th>
                        <th class="p-8 text-[11px] font-black uppercase text-slate-400 tracking-widest">Articles</th>
                        <th class="p-8 text-[11px] font-black uppercase text-slate-400 tracking-widest text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-50">
                    <tr class="hover:bg-slate-50/50 transition group">
                        <td class="p-8">
                            <div class="flex items-center gap-4">
                                <div class="w-14 h-14 bg-blue-50 text-blue-600 rounded-2xl flex items-center justify-center text-xl shadow-inner">
                                    <i class="fas fa-car"></i>
                                </div>
                                <div>
                                    <span class="font-black text-slate-800 block">Entretien Auto</span>
                                    <span class="text-[10px] text-slate-400 font-bold uppercase tracking-tight">ID: #0122</span>
                                </div>
                            </div>
                        </td>
                        <td class="p-8">
                            <p class="text-sm text-slate-500 max-w-xs leading-relaxed">Conseils pratiques pour maintenir votre moteur en parfait état.</p>
                        </td>
                        <td class="p-8">
                            <span class="bg-slate-100 text-slate-600 px-4 py-1.5 rounded-full text-xs font-black">24</span>
                        </td>
                        <td class="p-8">
                            <div class="flex justify-end gap-3">
                                <button onclick="openEditModal(1, 'Entretien Auto', 'Conseils pratiques...')" class="w-11 h-11 bg-slate-50 text-slate-400 rounded-xl hover:bg-blue-600 hover:text-white transition shadow-sm">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button onclick="handleDelete(1, 'Entretien Auto')" class="w-11 h-11 bg-slate-50 text-slate-400 rounded-xl hover:bg-red-500 hover:text-white transition shadow-sm">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </main>

    <div id="themeModal" class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm hidden items-center justify-center z-[150] p-4">
        <div class="bg-white w-full max-w-lg rounded-[3rem] p-10 shadow-2xl scale-95 animate-in zoom-in duration-300">
            <h3 id="modalTitle" class="text-3xl font-black text-slate-800 mb-8">Ajouter Thème</h3>

            <form id="themeForm" action="../controler/ThermeContoler.php" method="POST"  class="space-y-6">
                <input type="hidden" id="themeId">
                <div>
                    <label class="text-[10px] font-black uppercase text-slate-400 tracking-widest block mb-2 ml-2">Nom du Thème</label>
                    <input type="text" id="themeName" name="nomTheme" required class="w-full p-5 bg-slate-50 border-none rounded-2xl outline-none focus:ring-4 focus:ring-blue-500/10 transition">
                </div>
                <div>
                    <label name="descriptionTheme" class="text-[10px] font-black uppercase text-slate-400 tracking-widest block mb-2 ml-2">Description</label>
                    <textarea id="themeDesc" rows="4" class="w-full p-5 bg-slate-50 border-none rounded-2xl outline-none focus:ring-4 focus:ring-blue-500/10 transition"></textarea>
                </div>

                <div class="flex gap-4 pt-4">
                    <button type="button" onclick="closeModal('themeModal')" class="flex-1 py-5 font-bold text-slate-400 bg-slate-100 rounded-2xl hover:bg-slate-200 transition">Annuler</button>
                    <button type="submit" class="flex-1 py-5 bg-blue-600 text-white rounded-2xl font-black shadow-xl shadow-blue-200 hover:bg-blue-700 transition">Confirmer</button>
                </div>
            </form>
        </div>
    </div>

    <div id="toast" class="fixed bottom-10 left-1/2 -translate-x-1/2 z-[200] transform translate-y-32 opacity-0 transition-all duration-500">
        <div class="bg-slate-900 text-white px-8 py-4 rounded-2xl shadow-2xl flex items-center gap-4">
            <div id="toastIcon" class="w-8 h-8 rounded-full bg-green-500 flex items-center justify-center text-xs">
                <i class="fas fa-check"></i>
            </div>
            <p id="toastMsg" class="font-bold text-sm"></p>
        </div>
    </div>

    <div id="actionModal" class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm hidden items-center justify-center z-[200] p-4">
        <div class="bg-white w-full max-w-sm rounded-[2.5rem] p-10 shadow-2xl text-center">
            <div id="actionIconBg" class="w-20 h-20 rounded-full flex items-center justify-center mx-auto mb-6 text-2xl">
                <i id="actionIcon" class="fas"></i>
            </div>
            <h3 id="actionTitle" class="text-2xl font-black text-slate-800 mb-2">Confirmation</h3>
            <p id="actionMsg" class="text-slate-500 text-sm mb-8 leading-relaxed"></p>
            <div class="flex gap-3">
                <button onclick="closeModal('actionModal')" class="flex-1 py-4 font-bold text-slate-400 bg-slate-50 rounded-xl">Non</button>
                <button id="confirmActionBtn" class="flex-1 py-4 text-white rounded-xl font-black shadow-lg">Oui, continuer</button>
            </div>
        </div>
    </div>

    <script>
        // --- Modal Logic ---
        function openAddModal() {
            document.getElementById('modalTitle').innerText = "Nouveau Thème";
            document.getElementById('themeForm').reset();
            document.getElementById('themeId').value = "";
            showModal('themeModal');
        }

        function openEditModal(id, name, desc) {
            document.getElementById('modalTitle').innerText = "Modifier Thème";
            document.getElementById('themeId').value = id;
            document.getElementById('themeName').value = name;
            document.getElementById('themeDesc').value = desc;
            showModal('themeModal');
        }

        function showModal(id) {
            const m = document.getElementById(id);
            m.classList.remove('hidden');
            m.classList.add('flex');
        }

        function closeModal(id) {
            const m = document.getElementById(id);
            m.classList.add('hidden');
            m.classList.remove('flex');
        }

        // --- Action Modal (Delete) ---
        function handleDelete(id, name) {
            const iconBg = document.getElementById('actionIconBg');
            const icon = document.getElementById('actionIcon');
            const btn = document.getElementById('confirmActionBtn');

            iconBg.className = "w-20 h-20 bg-red-50 text-red-500 rounded-full flex items-center justify-center mx-auto mb-6 text-2xl";
            icon.className = "fas fa-trash-alt";
            btn.className = "flex-1 py-4 bg-red-500 text-white rounded-xl font-black shadow-lg";

            document.getElementById('actionTitle').innerText = "Supprimer ?";
            document.getElementById('actionMsg').innerText = `Voulez-vous vraiment supprimer le thème "${name}" ?`;

            btn.onclick = () => {
                console.log("Delete triggered for ID:", id);
                closeModal('actionModal');
                showToast("Thème supprimé avec succès", "success");
            };

            showModal('actionModal');
        }

        // --- Toast Logic ---
        function showToast(msg, type) {
            const t = document.getElementById('toast');
            document.getElementById('toastMsg').innerText = msg;
            t.classList.remove('translate-y-32', 'opacity-0');
            t.classList.add('translate-y-0', 'opacity-100');
            setTimeout(() => {
                t.classList.add('translate-y-32', 'opacity-0');
                t.classList.remove('translate-y-0', 'opacity-100');
            }, 3000);
        }

        // --- Form Submission ---
        document.getElementById('themeForm').onsubmit = (e) => {
            e.preventDefault();
            const id = document.getElementById('themeId').value;
            closeModal('themeModal');
            showToast(id ? "Thème mis à jour !" : "Thème créé avec succès !", "success");
        }
    </script>
</body>

</html> -->