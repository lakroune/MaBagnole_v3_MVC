 <aside class="w-64 bg-slate-900 min-h-screen text-white flex flex-col sticky top-0 hidden md:flex">
     <div class="p-6 flex-1">
         <div class="mb-10">
             <span class="text-2xl font-black text-blue-500">Ma<span class="text-white">Bagnole</span></span>
             <p class="text-[10px] text-slate-400 tracking-widest uppercase mt-1">Admin Panel</p>
         </div>

         <nav class="space-y-1">
             <a href="admin_dashboard" class="flex items-center gap-3 text-blue-500 font-bold bg-blue-500/10 p-3 rounded-xl">
                 <i class="fas fa-chart-line"></i> Dashboard
             </a>
             <a href="admin_fleet" class="flex items-center gap-3 text-slate-400 hover:text-white transition p-3">
                 <i class="fas fa-car"></i> Fleet
             </a>
             <a href="admin_reservations" class="flex items-center gap-3 text-slate-400 hover:text-white transition p-3">
                 <i class="fas fa-calendar-check"></i> Reservations
             </a>
             <a href="admin_categories" class="flex items-center gap-3 text-slate-400 hover:text-white transition p-3">
                 <i class="fas fa-tags"></i> Categories
             </a>
             <a href="admin_reviews" class="flex items-center gap-3 text-slate-400 hover:text-white transition p-3">
                 <i class="fas fa-star"></i> Manage Reviews
             </a>
             <a href="admin_clients" class="flex items-center gap-3 text-slate-400 hover:text-white transition p-3">
                 <i class="fas fa-users"></i> Clients
             </a>
             <a href="admin_articles" class="flex items-center gap-3 text-slate-400 hover:text-white transition p-3">
                 <i class="fas fa-newspaper"></i> Articles
             </a>
             <a href="admin_themes" class="flex items-center gap-3 text-slate-400 hover:text-white transition p-3">
                 <i class="fas fa-th-large"></i> Themes
             </a>
             <a href="admin_tags" class="flex items-center gap-3 text-slate-400 hover:text-white transition p-3">
                 <i class="fas fa-tags"></i> Tags
             </a>
         </nav>
     </div>

     <div class="p-4 border-t border-slate-800">
         <button onclick="toggleLogoutModal()" class="flex items-center gap-3 p-3 text-red-400 hover:bg-red-500/10 rounded-xl transition font-bold">
             <i class="fas fa-sign-out-alt"></i> Logout
         </button>
     </div>
 </aside>
 <div id="logout" class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm hidden items-center justify-center z-[110] p-4">
     <div class="bg-white w-full max-w-md rounded-[2.5rem] p-8 shadow-2xl">
         <div class="flex justify-between items-center mb-6">
             <h3 class="text-2xl font-black text-slate-800">Déconnexion</h3>
             <button onclick="closeLogoutModal()" class="text-slate-300 hover:text-slate-600"><i class="fas fa-times"></i></button>
         </div>
         <p class="text-slate-500 text-sm mb-8 leading-relaxed">Voulez-vous vraiment vous d&eacute;connecter ?</p>
         <div class="flex gap-3">
             <button onclick="closeLogoutModal()" class="flex-1 py-4 font-bold text-slate-400 bg-slate-50 rounded-2xl hover:bg-slate-100 transition">Annuler</button>
             <button onclick="logout()" class="flex-1 py-4 text-white bg-red-600 rounded-2xl font-black shadow-lg transition transform hover:scale-105 active:scale-95">Confirmer</button>
         </div>
     </div>
 </div>
 <script>
     function logout() {
         window.location.href = 'logout';
     }

     function toggleLogoutModal() {
         document.getElementById('logout').classList.replace('hidden', 'flex');
     }


     function closeLogoutModal() {
         document.getElementById('logout').classList.replace('flex', 'hidden');
     }
 </script>