<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MaBagnole | Blog & Themes</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        .theme-card:hover .theme-icon { transform: scale(1.1) rotate(-5deg); }
        .sticky-search { position: sticky; top: 0; z-index: 40; }
    </style>
</head>
<body class="bg-slate-50 min-h-screen">

    <header class="bg-white border-b border-slate-100 px-8 py-12">
        <div class="max-w-7xl mx-auto flex flex-col md:flex-row justify-between items-center gap-6">
            <div>
                <h1 class="text-4xl font-black text-slate-900 mb-2">MaBagnole <span class="text-blue-600">Blog</span></h1>
                <p class="text-slate-500 font-medium">Partagez votre passion pour l'automobile avec la communauté.</p>
            </div>
            
            <div class="flex gap-4 w-full md:w-auto">
                <button onclick="toggleModal('addArticleModal')" class="bg-slate-900 text-white px-6 py-4 rounded-2xl font-black hover:bg-blue-600 transition flex items-center gap-2 shadow-lg">
                    <i class="fas fa-plus"></i> Nouveau Article
                </button>
            </div>
        </div>

        <div class="max-w-4xl mx-auto mt-10">
            <div class="relative group">
                <i class="fas fa-search absolute left-5 top-1/2 -translate-y-1/2 text-slate-400 group-focus-within:text-blue-600 transition"></i>
                <input type="text" placeholder="Rechercher un titre d'article..." 
                       class="w-full pl-14 pr-32 py-5 bg-slate-50 border border-slate-200 rounded-2xl outline-none focus:ring-4 focus:ring-blue-500/10 transition shadow-sm">
                <button class="absolute right-3 top-1/2 -translate-y-1/2 bg-blue-600 text-white px-6 py-3 rounded-xl font-bold hover:bg-blue-700 transition">Chercher</button>
            </div>
            
            <div class="flex flex-wrap gap-2 mt-4 justify-center">
                <span class="px-4 py-1.5 bg-blue-50 text-blue-600 text-[11px] font-black rounded-full cursor-pointer hover:bg-blue-100 transition">#Conseils</span>
                <span class="px-4 py-1.5 bg-slate-100 text-slate-600 text-[11px] font-black rounded-full cursor-pointer hover:bg-slate-200 transition">#Vitesse</span>
                <span class="px-4 py-1.5 bg-slate-100 text-slate-600 text-[11px] font-black rounded-full cursor-pointer hover:bg-slate-200 transition">#Entretien</span>
                <span class="px-4 py-1.5 bg-slate-100 text-slate-600 text-[11px] font-black rounded-full cursor-pointer hover:bg-slate-200 transition">#Electrique</span>
            </div>
        </div>
    </header>

    <main class="max-w-7xl mx-auto px-8 py-12">
        <h2 class="text-2xl font-black text-slate-800 mb-8 flex items-center gap-3">
            <i class="fas fa-layer-group text-blue-600"></i> Explorer par Thèmes
        </h2>
        
        <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-4 mb-16">
            <a href="theme_articles.php?id=1" class="theme-card bg-white p-6 rounded-[2rem] border border-slate-100 text-center hover:border-blue-500 transition-all shadow-sm group">
                <div class="theme-icon w-12 h-12 bg-blue-50 text-blue-600 rounded-2xl flex items-center justify-center mx-auto mb-3 transition-transform">
                    <i class="fas fa-road text-xl"></i>
                </div>
                <p class="font-black text-slate-800 text-sm group-hover:text-blue-600 transition">Voyages</p>
            </a>
            </div>

        <div class="flex justify-between items-end mb-8">
            <h2 class="text-2xl font-black text-slate-800">Articles Récents</h2>
            <div class="flex items-center gap-3 text-sm font-bold text-slate-400">
                Afficher :
                <select class="bg-transparent border-none focus:ring-0 text-blue-600 cursor-pointer">
                    <option>5 par page</option>
                    <option selected>10 par page</option>
                    <option>15 par page</option>
                </select>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <div class="bg-white rounded-[2.5rem] overflow-hidden border border-slate-100 shadow-sm hover:shadow-xl transition group">
                <div class="h-52 overflow-hidden relative">
                    <img src="https://images.unsplash.com/photo-1492144534655-ae79c964c9d7?w=800" class="w-full h-full object-cover">
                    <button class="absolute top-4 right-4 w-10 h-10 bg-white/90 backdrop-blur rounded-full flex items-center justify-center text-slate-400 hover:text-red-500 transition shadow-sm">
                        <i class="fas fa-heart"></i>
                    </button>
                </div>
                <div class="p-8">
                    <div class="flex items-center gap-2 mb-3">
                        <span class="text-[10px] font-black uppercase tracking-widest text-blue-600">Voyages</span>
                        <span class="text-slate-300">•</span>
                        <span class="text-[10px] font-bold text-slate-400">Il y a 2h</span>
                    </div>
                    <h3 class="text-xl font-black text-slate-800 mb-4 group-hover:text-blue-600 transition">Top 5 des routes pour tester votre Porsche</h3>
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-2">
                            <div class="w-8 h-8 rounded-full bg-slate-100 overflow-hidden border-2 border-white shadow-sm">
                                <img src="https://i.pravatar.cc/100?u=ahmed">
                            </div>
                            <span class="text-xs font-bold text-slate-600">Ahmed B.</span>
                        </div>
                        <a href="article_detail.php?id=1" class="text-xs font-black text-blue-600 flex items-center gap-1 hover:gap-2 transition-all">
                            Lire <i class="fas fa-arrow-right"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="mt-12 flex justify-center items-center gap-3">
            <button class="px-6 py-2 rounded-xl bg-white border border-slate-200 text-slate-400 font-bold hover:bg-slate-50 transition">Précédent</button>
            <span class="text-sm font-black text-slate-800">Page 1 / 12</span>
            <button class="px-6 py-2 rounded-xl bg-slate-900 text-white font-bold hover:bg-blue-600 transition">Suivant</button>
        </div>
    </main>

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