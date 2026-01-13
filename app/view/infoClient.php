<?php


if (!isset($_SESSION['Utilisateur']) || $_SESSION['Utilisateur']->getRole() !== 'client') :

?>


    <div class="flex items-center gap-4">
        <a href="login" class="text-sm font-bold text-slate-600">Sign In</a>
        <a href="register" class="bg-blue-600 text-white px-6 py-2.5 rounded-xl text-sm font-bold shadow-lg shadow-blue-100">Register</a>
    </div>

<?php else : ?>
    <div class="flex items-center gap-4">
        <div class="text-right hidden sm:block">
            <p class="text-xs font-bold text-slate-800">Welcome, <?php echo $_SESSION['Utilisateur']->getNomUtilisateur(); ?></p>
            <button  onclick="toggleLogoutModal()" class="text-[10px] text-red-500 font-black uppercase tracking-widest hover:underline">Logout</button>
        </div>
        <div class="w-10 h-10 rounded-full bg-blue-600 border-2 border-blue-100 flex items-center justify-center text-white font-bold shadow-sm">
            <?= strtoupper($_SESSION['Utilisateur']->getNomUtilisateur()[0] . "." . $_SESSION['Utilisateur']->getPrenomUtilisateur()[0]) ?>
        </div>
    </div>

<?php endif; ?>











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
        window.location.href = 'logout.php';
    }

    function toggleLogoutModal() {
        document.getElementById('logout').classList.replace('hidden', 'flex');
    }


    function closeLogoutModal() {
        document.getElementById('logout').classList.replace('flex', 'hidden');
    }
</script>