# MaBagnole - Plateforme de Location de Véhicules
---
**MaBagnole** est une solution web complète conçue pour une agence de location de voitures.  
Elle permet aux clients de réserver des véhicules en ligne et d’interagir avec la plateforme via des fonctionnalités modernes.  
Le projet est développé en **PHP orienté objet (POO)** avec une architecture **SQL robuste**.
---
## 🛠️ Stack Technique
### Framework
- (MVC, Routing)

### Backend
- PHP 8.x (Programmation Orientée Objet)

### Base de données
- MySQL (Vues, Procédures stockées, Triggers)

### Frontend
- HTML5  
- CSS3  
- JavaScript (AJAX et filtres sans rechargement de page avec DataTables et jQuery)

### Outils & Librairies
- Composer (gestion des dépendances & autoload)
- DataTables (pagination et recherche dynamique)

### Conception
- UML (diagrammes de classes & cas d'utilisation)
---
## 🚀 Fonctionnalités Principales

### 👤 Espace Client

- S'inscrire
- Se connecter
- Rechercher des véhicules
- Faire une reservation
- Consulter ses reservations
- Consulter ses avis
- Publier un avis
### 👥 Espace Admin

- Gestion des utilisateurs
- Gestion des véhicules
- Gestion des avis
- Gestion des reservations
- Gestion des Categories
---

## 🏗️ Architecture de la Base de Données

- Vue SQL `ListeVehicules` : regroupe véhicules, catégories et moyenne des notes
- Procédure stockée :
        `AjouterReservation` : vérifie la disponibilité avant insertion
        'supprimerAvis' : supprime un avis
        'supprimerReservation' : supprime une reservation
        'supprimerVehicule' : supprime un vehicule
        'supprimerCategorie' : supprime une categorie

---

## 📁 Structure du Projet

MaBagnole-v3-MVC/        -le dossier principal
├── app/                 -les classes de vos applications
│   ├── Models/          -les classes de vos modèles
│   ├── Controllers/     -les classes de vos contrôleurs
│   └── Views/           -les classes de vos vues
├── core/                -la classe de routage
|   └── Router.php       -la classe de routage
├── vendor/              -les dépendances
├── conception/          -les diagrammes
├── database/            -la base de données
├── composer.json        -le fichier de configuration de Composer
├── index.php            -le point d'accueil
├── .htaccess            -le fichier de configuration d'Apache
└── readme.md            -le fichier de documentation
---

## ⚙️ Installation

### 1. Cloner le dépôt
git clone https://github.com/lakrouen/mabagnole_v1.git

### 2. Installer les dépendances
composer install  
composer dump-autoload

### 3. Lancer le projet
Utilisez XAMPP, Laragon ou le serveur PHP intégré.
---
## 📊 Conception UML
Architecture UML claire assurant maintenabilité et extensibilité.
---
## 📜 License
Ce projet est sous la license [MIT](https://github.com/lakroune/mabagnole_v1/blob/main/LICENSE).