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
            <a href="blog_main.php" class="text-sm font-bold text-slate-500 hover:text-blue-600 transition">Blog</a>
            <a href="catalogue.php" class="text-sm font-bold text-slate-500 hover:text-blue-600 transition">Véhicules</a>
            <div class="w-10 h-10 rounded-full bg-slate-100 border-2 border-white shadow-sm overflow-hidden">
                <img src="https://i.pravatar.cc/100?u=me">
            </div>
        </div>
    </nav>

    <header class="py-16 bg-white border-b border-slate-100 text-center px-4">
        <h1 class="text-4xl font-black text-slate-900 mb-4">Explorez par <span class="text-blue-600">Thématiques</span></h1>
        <p class="text-slate-500 max-w-xl mx-auto font-medium">
            Trouvez des articles passionnants classés par catégories pour approfondir vos connaissances automobiles.
        </p>
    </header>

    <main class="max-w-7xl mx-auto px-8 py-16">
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
            
            <a href="theme_articles.php?id=1" class="group relative bg-white rounded-[2.5rem] p-8 border border-slate-100 shadow-sm hover:shadow-2xl hover:-translate-y-2 transition-all duration-300 overflow-hidden">
                <div class="absolute -right-4 -top-4 w-24 h-24 bg-blue-50 rounded-full group-hover:scale-[3] transition-transform duration-700"></div>
                
                <div class="relative z-10">
                    <div class="w-16 h-16 bg-blue-600 text-white rounded-2xl flex items-center justify-center text-2xl shadow-lg shadow-blue-100 mb-6">
                        <i class="fas fa-road"></i>
                    </div>
                    <h3 class="text-2xl font-black text-slate-800 mb-2">Voyages & Routes</h3>
                    <p class="text-slate-500 text-sm leading-relaxed mb-6">
                        Découvrez les plus beaux itinéraires et conseils pour vos road trips en famille ou entre amis.
                    </p>
                    <div class="flex items-center justify-between">
                        <span class="text-xs font-black text-blue-600 uppercase tracking-widest">12 Articles</span>
                        <div class="w-8 h-8 rounded-full bg-slate-50 flex items-center justify-center text-slate-400 group-hover:bg-blue-600 group-hover:text-white transition">
                            <i class="fas fa-arrow-right text-xs"></i>
                        </div>
                    </div>
                </div>
            </a>

            <a href="theme_articles.php?id=2" class="group relative bg-white rounded-[2.5rem] p-8 border border-slate-100 shadow-sm hover:shadow-2xl hover:-translate-y-2 transition-all duration-300 overflow-hidden">
                <div class="absolute -right-4 -top-4 w-24 h-24 bg-slate-50 rounded-full group-hover:scale-[3] transition-transform duration-700"></div>
                <div class="relative z-10">
                    <div class="w-16 h-16 bg-slate-900 text-white rounded-2xl flex items-center justify-center text-2xl shadow-lg mb-6">
                        <i class="fas fa-tools"></i>
                    </div>
                    <h3 class="text-2xl font-black text-slate-800 mb-2">Entretien & Mécanique</h3>
                    <p class="text-slate-500 text-sm leading-relaxed mb-6">
                        Apprenez à prendre soin de votre moteur et à maintenir votre véhicule dans un état irréprochable.
                    </p>
                    <div class="flex items-center justify-between">
                        <span class="text-xs font-black text-slate-400 uppercase tracking-widest">8 Articles</span>
                        <div class="w-8 h-8 rounded-full bg-slate-50 flex items-center justify-center text-slate-400 group-hover:bg-slate-900 group-hover:text-white transition">
                            <i class="fas fa-arrow-right text-xs"></i>
                        </div>
                    </div>
                </div>
            </a>

            <a href="theme_articles.php?id=3" class="group relative bg-white rounded-[2.5rem] p-8 border border-slate-100 shadow-sm hover:shadow-2xl hover:-translate-y-2 transition-all duration-300 overflow-hidden">
                <div class="absolute -right-4 -top-4 w-24 h-24 bg-green-50 rounded-full group-hover:scale-[3] transition-transform duration-700"></div>
                <div class="relative z-10">
                    <div class="w-16 h-16 bg-green-500 text-white rounded-2xl flex items-center justify-center text-2xl shadow-lg shadow-green-100 mb-6">
                        <i class="fas fa-leaf"></i>
                    </div>
                    <h3 class="text-2xl font-black text-slate-800 mb-2">Écomobilité</h3>
                    <p class="text-slate-500 text-sm leading-relaxed mb-6">
                        Tout sur les voitures électriques, hybrides et les nouvelles technologies respectueuses de l'environnement.
                    </p>
                    <div class="flex items-center justify-between">
                        <span class="text-xs font-black text-green-600 uppercase tracking-widest">15 Articles</span>
                        <div class="w-8 h-8 rounded-full bg-slate-50 flex items-center justify-center text-slate-400 group-hover:bg-green-500 group-hover:text-white transition">
                            <i class="fas fa-arrow-right text-xs"></i>
                        </div>
                    </div>
                </div>
            </a>

        </div>
    </main>

    <footer class="text-center py-10 border-t border-slate-100 mt-10">
        <p class="text-slate-400 text-xs font-bold uppercase tracking-widest">© 2026 MaBagnole Blog System</p>
    </footer>

</body>
</html>