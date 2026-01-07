<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MaBagnole Admin | Gestion des Tags</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
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
            <div id="tag-1" class="bg-white p-4 rounded-2xl border border-slate-100 shadow-sm flex items-center justify-between group hover:border-blue-500 transition">
                <span class="font-bold text-slate-700">#Vitesse</span>
                <button onclick="confirmDeleteTag(1, 'Vitesse')" class="text-slate-300 hover:text-red-500 transition opacity-0 group-hover:opacity-100">
                    <i class="fas fa-times-circle"></i>
                </button>
            </div>

            <div id="tag-2" class="bg-white p-4 rounded-2xl border border-slate-100 shadow-sm flex items-center justify-between group hover:border-blue-500 transition">
                <span class="font-bold text-slate-700">#Electrique</span>
                <button onclick="confirmDeleteTag(2, 'Electrique')" class="text-slate-300 hover:text-red-500 transition opacity-0 group-hover:opacity-100">
                    <i class="fas fa-times-circle"></i>
                </button>
            </div>
            </div>
    </main>

    <div id="bulkTagsModal" class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm hidden items-center justify-center z-[110] p-4">
        <div class="bg-white w-full max-w-md rounded-[2.5rem] p-8 shadow-2xl animate-in zoom-in duration-300">
            <div class="flex justify-between items-center mb-6">
                <h3 class="text-2xl font-black text-slate-800">Nouveaux Tags</h3>
                <button onclick="closeBulkTagsModal()" class="text-slate-300 hover:text-slate-600"><i class="fas fa-times"></i></button>
            </div>

            <p class="text-xs text-slate-400 font-bold uppercase mb-4 tracking-widest">Séparez les tags par des virgules</p>
            
            <form action="process_tags.php" method="POST">
                <textarea name="tags_list" rows="4" placeholder="Ex: Luxe, Sport, Voyage, Entretien..." 
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

    <script>
        function openBulkTagsModal() {
            const modal = document.getElementById('bulkTagsModal');
            modal.classList.remove('hidden');
            modal.classList.add('flex');
        }

        function closeBulkTagsModal() {
            const modal = document.getElementById('bulkTagsModal');
            modal.classList.add('hidden');
            modal.classList.remove('flex');
        }

        function confirmDeleteTag(id, name) {
            // استخدام الـ Action Popup الموحد
            openActionModal({
                type: 'danger',
                title: 'Supprimer le Tag',
                message: `Voulez-vous vraiment supprimer le tag #${name} ? Cela l'enlèvera de tous les articles.`,
                onConfirm: () => {
                    console.log("Tag " + id + " supprimé");
                    document.getElementById('tag-' + id).remove();
                }
            });
        }
    </script>
</body>
</html>