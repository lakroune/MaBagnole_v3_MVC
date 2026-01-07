<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MaBagnole | Article Details</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-slate-50 min-h-screen pb-20">

    <nav class="bg-white border-b border-slate-100 px-8 py-4 sticky top-0 z-50">
        <div class="max-w-5xl mx-auto flex justify-between items-center">
            <a href="blog_main.php" class="text-slate-400 hover:text-blue-600 font-bold flex items-center gap-2 transition">
                <i class="fas fa-arrow-left"></i> Retour au blog
            </a>
            <div class="text-xl font-black text-blue-600">Ma<span class="text-slate-800">Bagnole</span></div>
            <button class="w-10 h-10 bg-slate-50 rounded-full flex items-center justify-center text-slate-400 hover:text-red-500 transition">
                <i class="fas fa-heart"></i>
            </button>
        </div>
    </nav>

    <main class="max-w-4xl mx-auto mt-10 px-4">
        <article class="bg-white rounded-[3rem] overflow-hidden shadow-sm border border-slate-100">
            <div class="h-[400px] w-full relative">
                <img src="https://images.unsplash.com/photo-1492144534655-ae79c964c9d7?w=1200" class="w-full h-full object-cover">
                <div class="absolute bottom-8 left-8">
                    <span class="bg-blue-600 text-white px-4 py-1.5 rounded-full text-[10px] font-black uppercase tracking-widest">Voyages</span>
                </div>
            </div>

            <div class="p-8 md:p-12">
                <h1 class="text-4xl font-black text-slate-900 mb-6 leading-tight">
                    Top 5 des routes pour tester votre Porsche en 2025
                </h1>

                <div class="flex flex-wrap items-center justify-between gap-4 mb-10 pb-10 border-b border-slate-50">
                    <div class="flex items-center gap-3">
                        <img src="https://i.pravatar.cc/100?u=ahmed" class="w-12 h-12 rounded-2xl">
                        <div>
                            <p class="text-sm font-black text-slate-800">Ahmed Berrada</p>
                            <p class="text-xs text-slate-400 font-bold">Publié le 24 Oct, 2025</p>
                        </div>
                    </div>
                    <div class="flex gap-2">
                        <span class="text-[11px] font-bold text-slate-400 bg-slate-50 px-3 py-1 rounded-lg">#Vitesse</span>
                        <span class="text-[11px] font-bold text-slate-400 bg-slate-50 px-3 py-1 rounded-lg">#Sport</span>
                    </div>
                </div>

                <div class="prose prose-slate max-w-none text-slate-600 leading-relaxed text-lg">
                    <p class="mb-6">
                        L’expérience de conduite d’une Porsche ne se limite pas à la voiture elle-même, mais au ruban d'asphalte qui se défile sous ses roues. Que vous soyez amateur de virages serrés ou de longues lignes droites panoramiques...
                    </p>
                    <p>
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
                    </p>
                </div>
            </div>
        </article>

        <section class="mt-12">
            <h3 class="text-2xl font-black text-slate-800 mb-8">Commentaires (2)</h3>

            <div class="bg-white p-8 rounded-[2.5rem] shadow-sm border border-slate-100 mb-10">
                <div class="flex gap-4">
                    <img src="https://i.pravatar.cc/100?u=me" class="w-10 h-10 rounded-xl">
                    <div class="flex-1">
                        <textarea id="commentInput" placeholder="Ajouter un commentaire..." 
                                  class="w-full p-4 bg-slate-50 border-none rounded-2xl focus:ring-2 focus:ring-blue-500 outline-none transition min-h-[100px]"></textarea>
                        <div class="flex justify-end mt-3">
                            <button onclick="submitComment()" class="bg-blue-600 text-white px-8 py-3 rounded-xl font-black text-sm hover:bg-blue-700 transition shadow-lg shadow-blue-100">
                                Publier
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="space-y-6">
                <div class="bg-white p-6 rounded-[2rem] border border-slate-100 flex gap-4 relative group">
                    <img src="https://i.pravatar.cc/100?u=me" class="w-10 h-10 rounded-xl">
                    <div class="flex-1">
                        <div class="flex justify-between items-center mb-1">
                            <h4 class="font-black text-slate-800 text-sm">Moi (Vous)</h4>
                            <div class="flex gap-2 opacity-0 group-hover:opacity-100 transition">
                                <button onclick="editComment(1)" class="text-blue-500 text-xs font-bold hover:underline">Modifier</button>
                                <button onclick="confirmDelete(1)" class="text-red-500 text-xs font-bold hover:underline">Supprimer</button>
                            </div>
                        </div>
                        <p class="text-slate-500 text-sm">Super article ! J'ai hâte de tester cette route le week-end prochain.</p>
                        <p class="text-[10px] text-slate-300 font-bold mt-2 uppercase">Il y a 5 min</p>
                    </div>
                </div>

                <div class="bg-white p-6 rounded-[2rem] border border-slate-100 flex gap-4">
                    <img src="https://i.pravatar.cc/100?u=user2" class="w-10 h-10 rounded-xl">
                    <div class="flex-1">
                        <h4 class="font-black text-slate-800 text-sm mb-1">Sara K.</h4>
                        <p class="text-slate-500 text-sm">La route de l'Ourika est aussi magnifique pour ce genre de trajet !</p>
                        <p class="text-[10px] text-slate-300 font-bold mt-2 uppercase">Il y a 1 heure</p>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <script>
        function submitComment() {
            const input = document.getElementById('commentInput');
            if(!input.value) return; // Utiliser le Popup Error ici
            
            // Simulation Success Popup
            // showActionModal({ type: 'success', title: 'Succès', message: 'Commentaire publié !' });
            input.value = "";
        }

        function editComment(id) {
            // Logique pour ouvrir un modal d'édition
            console.log("Editing comment " + id);
        }

        function confirmDelete(id) {
            // Utiliser votre Action Popup ici
            // openActionModal({
            //     type: 'danger',
            //     title: 'Supprimer ?',
            //     message: 'Voulez-vous vraiment supprimer ce commentaire ?',
            //     onConfirm: () => { console.log('Deleted'); }
            // });
        }
    </script>

</body>
</html>