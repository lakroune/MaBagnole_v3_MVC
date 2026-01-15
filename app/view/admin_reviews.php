<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MaBagnole | Manage Reviews</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="./css/style.css">
</head>

<body class="bg-slate-50 min-h-screen flex">

    <?php include_once 'sidebar.php'; ?>

    <main class="flex-1 p-4 md:p-10 text-slate-800">
        <header class="mb-10 flex justify-between items-end">
            <div>
                <h2 class="text-3xl font-black text-slate-800">Customer Reviews</h2>
                <p class="text-slate-500">Moderate and manage feedback from your clients.</p>
            </div>
            <div class="bg-white px-6 py-3 rounded-2xl shadow-sm border border-slate-200">
                <span class="text-sm font-bold text-slate-400 uppercase tracking-widest">Total Reviews:</span>
                <span class="ml-2 text-xl font-black text-blue-600"><?= count($allReviews) ?></span>
            </div>
        </header>

        <div class="bg-white rounded-[2.5rem] shadow-sm border border-slate-200 p-8">
            <table id="reviewsTable" class="w-full">
                <thead>
                    <tr class="text-left text-slate-400 uppercase text-[11px] font-black tracking-wider">
                        <th class="pb-4">Client / Vehicle</th>
                        <th class="pb-4">Review Content</th>
                        <th class="pb-4">Rating</th>
                        <th class="pb-4">Status</th>
                        <th class="pb-4 text-center">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    <?php foreach ($allReviews as $review): ?>
                        <?php

                        $client = $client->getClientById($review->getIdClient());
                        $reservation = $reservation->getReservation($review->getIdReservation());
                        $vehicule = $vehicule->getVehiculeById($reservation->getIdVehicule());
                        ?>
                        <tr class="hover:bg-slate-50/50 transition">
                            <td class="py-6">
                                <div class="flex flex-col">
                                    <span class="font-bold text-slate-800 text-sm"><?= htmlspecialchars($client->getNomUtilisateur()) ?></span>
                                    <span class="text-[10px] text-blue-500 font-bold uppercase"><?= htmlspecialchars($vehicule->getModeleVehicule()) ?></span>
                                </div>
                            </td>
                            <td class="py-6 max-w-xs">
                                <p class="text-sm text-slate-600 italic">"<?= htmlspecialchars($review->getCommentaireAvis()) ?>"</p>
                                <span class="text-[10px] text-slate-400"><?= $review->getDatePublicationAvis() ?></span>
                            </td>
                            <td class="py-6 text-orange-400">
                                <?php for ($i = 1; $i <= 5; $i++): ?>
                                    <i class="<?= $i <= $review->getNoteAvis() ? 'fas' : 'far text-slate-200' ?> fa-star text-xs"></i>
                                <?php endfor; ?>
                            </td>
                            <td class="py-6">
                                <?php if ($review->getStatusAvis() === 0): ?>
                                    <span class="px-3 py-1 bg-amber-50 text-amber-600 rounded-full text-[10px] font-black uppercase">Pending</span>
                                <?php else: ?>
                                    <span class="px-3 py-1 bg-green-50 text-green-600 rounded-full text-[10px] font-black uppercase">Visible</span>
                                <?php endif; ?>
                            </td>
                            <td class="py-6">
                                <div class="flex justify-center gap-2">
                                    <?php if ($review->getStatusAvis() === 0): ?>
                                        <button onclick="handleApprove(<?= $review->getIdAvis() ?>)" class="w-9 h-9 bg-green-50 text-green-600 rounded-xl hover:bg-green-600 hover:text-white transition shadow-sm" title="Approve">
                                            <i class="fas fa-check"></i>
                                        </button>
                                    <?php else: ?>
                                        <button onclick="handleDelete(<?= $review->getIdAvis() ?>)" class="w-9 h-9 bg-red-50 text-red-500 rounded-xl hover:bg-red-600 hover:text-white transition shadow-sm" title="Delete">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    <?php endif; ?>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </main>

    <div id="actionModal" class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm hidden items-center justify-center z-[110] p-4">
        <div class="bg-white w-full max-w-sm rounded-[2.5rem] p-8 shadow-2xl text-center relative animate-in">
            <div id="actionIconBg" class="w-20 h-20 rounded-full flex items-center justify-center mx-auto mb-6 text-3xl text-white">
                <i id="actionIcon" class="fas"></i>
            </div>
            <h3 id="actionTitle" class="text-2xl font-black text-slate-800 mb-2 tracking-tight">Confirmation</h3>
            <p id="actionMessage" class="text-slate-500 text-sm mb-8 leading-relaxed">Are you sure about this action?</p>
            <form method="POST" id="formActionModel">
                <input type="hidden" name="idAvis" id="actionId" required>
                <input type="hidden" name="page" value="admin_reviews">
                <input type="hidden" name="action" id="action" required>

                <div class="flex gap-3">
                    <button onclick="closeActionModal()" type="button" class=" flex-1 py-4 font-bold text-slate-400 bg-slate-50 rounded-2xl hover:bg-slate-100 transition">Cancel</button>
                    <button id="confirmBtn" class="flex-1 py-4 rounded-2xl font-black text-white shadow-lg transition active:scale-95">Confirm</button>
                </div>
            </form>
        </div>
    </div>
    <div id="errorModal" class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm hidden items-center justify-center z-[100] p-4">
        <div class="bg-white w-full max-w-sm rounded-[2.5rem] p-8 shadow-2xl text-center relative animate-bounce-short">
            <button onclick="closeError()" class="absolute top-6 right-6 text-slate-300 hover:text-slate-600">
                <i class="fas fa-times"></i>
            </button>

            <div class="w-20 h-20 bg-red-50 text-red-500 rounded-full flex items-center justify-center mx-auto mb-6 text-3xl">
                <i class="fas fa-exclamation-circle"></i>
            </div>

            <h3 class="text-2xl font-black text-slate-800 mb-2">Error</h3>
            <p id="errorMessage" class="text-slate-500 text-sm mb-8 leading-relaxed">
                yor reservation failed please try again .
            </p>

            <div class="flex flex-col gap-3">
                <button onclick="closeError()" class="w-full bg-slate-50 text-slate-600 py-4 rounded-2xl font-bold hover:bg-slate-100 transition">try again</button>

                <a href="accueil.php" class="text-sm font-bold text-blue-600 hover:underline">
                    <i class="fas fa-arrow-left mr-2"></i>back to fleet</a>
            </div>
        </div>
    </div>
    <div id="successModal" class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm hidden items-center justify-center z-[100] p-4">
        <div class="bg-white w-full max-w-sm rounded-[2.5rem] p-8 shadow-2xl text-center relative animate-fade-in">

            <div class="w-20 h-20 bg-green-50 text-green-500 rounded-full flex items-center justify-center mx-auto mb-6 text-3xl">
                <i class="fas fa-check-circle"></i>
            </div>

            <h3 class="text-2xl font-black text-slate-800 mb-2">Success!</h3>
            <p class="text-slate-500 text-sm mb-8 leading-relaxed">
                your reservation has been made successfully
            </p>

            <div class="flex flex-col gap-3">

                <a href="accueil.php" class=" feedback w-full bg-slate-900 text-white py-4 rounded-2xl font-black shadow-lg hover:bg-slate-800 transition">
                    <i class="fas fa-arrow-left mr-2"></i> Back to Fleet
                </a>
            </div>
        </div>
    </div>
    <div id="statusModal" class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm hidden items-center justify-center z-[200] p-4">
        <div class="bg-white w-full max-w-sm rounded-[2.5rem] p-8 shadow-2xl text-center relative">
            <button onclick="closeStatusModal()" class="absolute top-6 right-6 text-slate-300 hover:text-slate-600">
                <i class="fas fa-times"></i>
            </button>

            <div id="statusIconContainer" class="w-20 h-20 rounded-full flex items-center justify-center mx-auto mb-6 text-3xl border-4 border-white shadow-sm">
                <i id="statusIcon" class="fas"></i>
            </div>

            <h3 id="statusTitle" class="text-2xl font-black text-slate-800 mb-2"></h3>
            <p id="statusMessage" class="text-slate-500 text-sm mb-8 leading-relaxed"></p>

            <button onclick="closeStatusModal()" id="statusBtn" class="w-full text-white py-4 rounded-2xl font-black shadow-lg transition active:scale-95">
                Dismiss
            </button>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="<?= PATH_ROOT ?>/app/view/js/main.js"></script>
    <script>
        $(document).ready(function() {
            $('#reviewsTable').DataTable({
                pageLength: 6,
                ordering: true,
                dom: '<"flex justify-between items-center mb-6"f>rtip',
                language: {
                    search: "",
                    searchPlaceholder: "Search reviews..."
                }
            });
        });

        window.onload = function() {

            const path = window.location.pathname;
            const parts = path.split('/');
            const resultat = parts[parts.length - 1];
            const action = parts[parts.length - 2];
            if (action === "delete" && resultat === "success") {
                showStatusModal('success', 'Operation Successful', 'The review has been deleted successfully.');
            }
            if (action === "approve" && resultat === "success") {
                showStatusModal('success', 'Operation Successful', 'The review has been approved successfully.');
            }
            if (action === "reject" && resultat === "success") {
                showStatusModal('success', 'Operation Successful', 'The review has been rejected successfully.');
            }
            if ((action === "delete" || action === "approve" || action === "reject") && resultat === "failed") {
                showStatusModal('error', 'Operation Failed', 'Something went wrong. Please try again.');
            }
        }

        function closeActionModal() {
            document.getElementById('actionModal').classList.replace('flex', 'hidden');
        }

        function openActionModal(config) {
            const modal = document.getElementById('actionModal');
            const iconBg = document.getElementById('actionIconBg');
            const icon = document.getElementById('actionIcon');
            const title = document.getElementById('actionTitle');
            const message = document.getElementById('actionMessage');
            const confirmBtn = document.getElementById('confirmBtn');
            const formActionModel = document.getElementById('formActionModel');

            document.getElementById('actionId').value = config.id;
            document.getElementById('action').value = config.action;

            formActionModel.action = config.formAction;

            if (config.type === 'danger') {
                iconBg.className = "w-20 h-20 bg-red-500 text-white rounded-full flex items-center justify-center mx-auto mb-6 text-3xl shadow-lg shadow-red-100";
                icon.className = "fas fa-trash-alt";
                confirmBtn.className = "flex-1 py-4 rounded-2xl font-black text-white shadow-lg bg-red-500 hover:bg-red-600";
            } else {
                iconBg.className = "w-20 h-20 bg-green-500 text-white rounded-full flex items-center justify-center mx-auto mb-6 text-3xl shadow-lg shadow-green-100";
                icon.className = "fas fa-check";
                confirmBtn.className = "flex-1 py-4 rounded-2xl font-black text-white shadow-lg bg-green-500 hover:bg-green-600";
            }

            title.innerText = config.title;
            message.innerText = config.message;
            confirmBtn.innerText = config.confirmText || "Confirm";

            modal.classList.remove('hidden');
            modal.classList.add('flex');
        }

        function handleApprove(id) {
            openActionModal({
                id: id,
                action: 'approve',
                type: 'success',
                title: 'Approve Review',
                message: 'Do you want to make this review public?',
                confirmText: 'Yes, Approve',
                formAction: '<?php echo PATH_ROOT ?>/avis/approve'
            });
        }

        function handleDelete(id) {
            openActionModal({
                id: id,
                action: 'reject',
                type: 'danger',
                title: 'Delete Review',
                message: 'Are you sure? This action cannot be undone.',
                confirmText: 'Yes, Delete',
                formAction: '<?php echo PATH_ROOT ?>/avis/delete'
            });
        }
    </script>
</body>

</html>