<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>404 - Page Introuvable | MaBagnole</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;800&display=swap');
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        
        .car-animation {
            animation: drive 4s infinite linear;
        }
        @keyframes drive {
            0% { transform: translateX(-100px) rotate(0deg); }
            50% { transform: translateX(100px) rotate(2deg); }
            100% { transform: translateX(-100px) rotate(0deg); }
        }
    </style>
</head>
<body class="bg-slate-50 min-h-screen flex flex-col items-center justify-center p-6 text-center">

    <div class="relative mb-12">
        <h1 class="text-[180px] md:text-[250px] font-black text-slate-100 leading-none select-none">404</h1>
        
        <div class="absolute inset-0 flex flex-col items-center justify-center mt-10">
            <div class="car-animation text-6xl text-blue-600 mb-4">
                <i class="fas fa-car-side"></i>
            </div>
            <div class="h-1.5 w-32 bg-slate-200 rounded-full blur-sm opacity-50"></div>
        </div>
    </div>

    <div class="max-w-md">
        <h2 class="text-3xl font-black text-slate-900 mb-4">Oups ! Mauvais virage.</h2>
        <p class="text-slate-500 font-medium mb-10 leading-relaxed">
            Il semble que vous ayez pris une route qui n'existe plus. Pas de panique, nous allons vous remettre sur la bonne voie.
        </p>

        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <a href="accueil" class="bg-slate-900 text-white px-8 py-4 rounded-2xl font-black shadow-xl shadow-slate-200 hover:bg-blue-600 transition flex items-center justify-center gap-2">
                <i class="fas fa-home text-xs"></i> Retour à l'accueil
            </a>
           
        </div>
    </div>

    <footer class="mt-20">
        <p class="text-[10px] font-black text-slate-300 uppercase tracking-[0.3em]">
            Ma<span class="text-blue-500">Bagnole</span> • 2026
        </p>
    </footer>

</body>
</html>