<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MaBagnole | Mes Articles Favoris</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-slate-50 min-h-screen">

    <nav class="bg-white border-b border-slate-100 px-8 py-5 sticky top-0 z-50">
        <div class="max-w-7xl mx-auto flex justify-between items-center">
            <div class="flex items-center gap-4">
                <a href="articles_list.php" class="text-slate-400 hover:text-blue-600 transition"><i class="fas fa-arrow-left"></i></a>
                <div class="text-xl font-black text-blue-600">Ma<span class="text-slate-800">Bagnole</span></div>
            </div>
            <h2 class="text-sm font-black text-slate-800 uppercase tracking-widest">Ma Bibliothèque</h2>
            <div class="w-10 h-10 rounded-full bg-blue-600 text-white flex items-center justify-center font-bold shadow-lg shadow-blue-100">
                MY
            </div>
        </div>
    </nav>

    <header class="py-12 bg-white border-b border-slate-100 mb-10">
        <div class="max-w-7xl mx-auto px-8 flex flex-col md:flex-row justify-between items-center gap-6">
            <div>
                <h1 class="text-3xl font-black text-slate-900">Articles <span class="text-red-500">Favoris</span></h1>
                <p class="text-slate-400 text-sm font-medium mt-1">Retrouvez ici toutes les lectures que vous avez enregistrées.</p>
            </div>
            <div class="bg-slate-100 px-6 py-3 rounded-2xl flex items-center gap-3">
                <i class="fas fa-bookmark text-blue-600"></i>
                <span class="text-sm font-black text-slate-700">4 Articles Sauvegardés</span>
            </div>
        </div>
    </header>

    <main class="max-w-7xl mx-auto px-8 pb-20">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            
            <div id="fav-1" class="bg-white rounded-[2.5rem] border border-slate-100 overflow-hidden shadow-sm hover:shadow-xl transition-all group">
                <div class="h-48 overflow-hidden relative">
                    <img src="https://images.unsplash.com/photo-1503376780353-7e6692767b70?w=800" class="w-full h-full object-cover">
                    <button onclick="confirmRemoveFavorite(1)" class="absolute top-4 right-4 w-10 h-10 bg-red-500 text-white rounded-full flex items-center justify-center shadow-lg hover:scale-110 transition">
                        <i class="fas fa-heart-broken"></i>
                    </button>
                    <div class="absolute bottom-4 left-4">
                        <span class="bg-white/90 backdrop-blur px-3 py-1 rounded-lg text-[9px] font-black uppercase tracking-widest text-blue-600">Sportive</span>
                    </div>
                </div>
                <div class="p-8">
                    <h3 class="text-lg font-black text-slate-800 mb-3 leading-tight group-hover:text-blue-600 transition">Pourquoi la Porsche 911 reste l'icône indétrônable ?</h3>
                    <p class="text-sm text-slate-400 line-clamp-2 mb-6">Un voyage à travers l'histoire d'une voiture qui a défié le temps et la physique...</p>
                    
                    <div class="flex justify-between items-center pt-4 border-t border-slate-50">
                        <span class="text-[10px] font-bold text-slate-300">Ajouté le 05/01</span>
                        <a href="article_detail.php?id=1" class="text-xs font-black text-blue-600 flex items-center gap-2 hover:translate-x-1 transition-transform">
                            Lire l'article <i class="fas fa-chevron-right text-[10px]"></i>
                        </a>
                    </div>
                </div>
            </div>

            <div id="fav-2" class="bg-white rounded-[2.5rem] border border-slate-100 overflow-hidden shadow-sm hover:shadow-xl transition-all group">
                <div class="h-48 overflow-hidden relative">
                    <img src="https://images.unsplash.com/photo-1492144534655-ae79c964c9d7?w=800" class="w-full h-full object-cover">
                    <button onclick="confirmRemoveFavorite(2)" class="absolute top-4 right-4 w-10 h-10 bg-red-500 text-white rounded-full flex items-center justify-center shadow-lg hover:scale-110 transition">
                        <i class="fas fa-heart-broken"></i>
                    </button>
                    <div class="absolute bottom-4 left-4">
                        <span class="bg-white/90 backdrop-blur px-3 py-1 rounded-lg text-[9px] font-black uppercase tracking-widest text-blue-600">Luxe</span>
                    </div>
                </div>
                <div class="p-8">
                    <h3 class="text-lg font-black text-slate-800 mb-3 leading-tight group-hover:text-blue-600 transition">Les secrets de l'intérieur d'une Bentley</h3>
                    <p class="text-sm text-slate-400 line-clamp-2 mb-6">Quand le savoir-faire artisanal rencontre la technologie de pointe.</p>
                    
                    <div class="flex justify-between items-center pt-4 border-t border-slate-50">
                        <span class="text-[10px] font-bold text-slate-300">Ajouté le 02/01</span>
                        <a href="article_detail.php?id=2" class="text-xs font-black text-blue-600 flex items-center gap-2 hover:translate-x-1 transition-transform">
                            Lire l'article <i class="fas fa-chevron-right text-[10px]"></i>
                        </a>
                    </div>
                </div>
            </div>

        </div>

        <div class="hidden flex-col items-center justify-center py-20 text-center">
            <div class="w-24 h-24 bg-slate-100 text-slate-300 rounded-full flex items-center justify-center text-4xl mb-6">
                <i class="fas fa-heart"></i>
            </div>
            <h3 class="text-xl font-black text-slate-800 mb-2">Votre liste est vide</h3>
            <p class="text-slate-400 text-sm mb-8">Vous n'avez pas encore ajouté d'articles à vos favoris.</p>
            <a href="articles_list.php" class="bg-blue-600 text-white px-8 py-3 rounded-xl font-black shadow-lg shadow-blue-100 hover:bg-blue-700 transition">
                Explorer les articles
            </a>
        </div>
    </main>

    <script>
        function confirmRemoveFavorite(id) {
            // استخدام الـ Action Popup الذي صنعناه سابقاً
            openActionModal({
                type: 'danger',
                title: 'Retirer des favoris ?',
                message: 'Voulez-vous vraiment supprimer cet article de votre liste personnelle ?',
                onConfirm: () => {
                    // Logic AJAX لغرض حذف المقال من قاعدة البيانات
                    document.getElementById('fav-' + id).classList.add('opacity-0', 'scale-95');
                    setTimeout(() => {
                        document.getElementById('fav-' + id).remove();
                        // يمكنك هنا إضافة Toast Success
                    }, 300);
                }
            });
        }
    </script>

</body>
</html>