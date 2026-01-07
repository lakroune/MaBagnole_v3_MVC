-- Active: 1765826464238@@127.0.0.1@3306@chalange_formation
-- 1. Création de la base de données
DROP DATABASE if EXISTS chalange_formation;
CREATE DATABASE chalange_formation;
USE chalange_formation;

-- 2. Table Formateurs (Côté "1" de la relation 1:N)
CREATE TABLE formateurs (
    id INT PRIMARY KEY AUTO_INCREMENT,
    nom VARCHAR(100) NOT NULL,
    specialite VARCHAR(100)
);

-- 3. Table Cours (Côté "N" de la relation 1:N)
CREATE TABLE cours (
    id INT PRIMARY KEY AUTO_INCREMENT,
    titre VARCHAR(150) NOT NULL,
    formateur_id INT,
    FOREIGN KEY (formateur_id) REFERENCES formateurs(id) ON DELETE CASCADE
);

-- 4. Table Etudiants
CREATE TABLE etudiants (
    id INT PRIMARY KEY AUTO_INCREMENT,
    nom VARCHAR(100) NOT NULL,
    email VARCHAR(100) UNIQUE
);

-- 5. Table Pivot : Inscription (Relation N:N entre Etudiants et Cours)
CREATE TABLE inscription (
    etudiant_id INT,
    cours_id INT,
    date_inscription DATE DEFAULT (CURRENT_DATE),
    PRIMARY KEY (etudiant_id, cours_id), -- Clé primaire composée
    FOREIGN KEY (etudiant_id) REFERENCES etudiants(id) ON DELETE CASCADE,
    FOREIGN KEY (cours_id) REFERENCES cours(id) ON DELETE CASCADE
);
-- Ajout des formateurs
-- 1. Formateurs diversifiés
INSERT INTO formateurs (nom, specialite) VALUES 
('Marc Lavoie', 'Data Science'),
('Sophie Fontaine', 'Développement Web'),
('Jean Castex', 'Cybersécurité'),
('Amélie Poulain', 'Design UX/UI'),
('Luc Besson', 'Intelligence Artificielle');

-- 2. Catalogue de cours (plusieurs cours par formateur)
INSERT INTO cours (titre, formateur_id) VALUES 
('Introduction à Python', 1),
('Machine Learning Avancé', 1),
('HTML & CSS Moderne', 2),
('JavaScript Frameworks', 2),
('Sécurité des Réseaux', 3),
('Figma pour Débutants', 4),
('Deep Learning', 5),
('Ethical Hacking', 3);

-- 3. Un groupe d'étudiants
INSERT INTO etudiants (nom, email) VALUES 
('Thomas Hernandez', 'thomas@test.com'),
('Léa Martin', 'lea@test.com'),
('Chloé Durand', 'chloe@test.com'),
('Yassine Ben', 'yassine@test.com'),
('Emma Watson', 'emma@test.com'),
('Hugo Boss', 'hugo@test.com'),
('Alice Roy', 'alice@test.com'),
('Omar Sy', 'omar@test.com'),
('Julie Gayet', 'julie@test.com'),
('Kevin Parker', 'kevin@test.com');

-- 4. Inscriptions croisées (La table pivot)
INSERT INTO inscription (etudiant_id, cours_id) VALUES 
(1, 1), (1, 2), (1, 3), -- Thomas est très actif
(2, 1), (2, 4),         -- Léa
(3, 1), (3, 5), (3, 8), -- Chloé
(4, 2), (4, 7),         -- Yassine
(5, 6),                 -- Emma (seulement Design)
(6, 1), (6, 3), (6, 5), -- Hugo
(7, 4), (7, 6),         -- Alice
(8, 7), (8, 8),         -- Omar
(9, 1), (9, 2);         -- Julie
select * from etudiants ORDER BY nom  asc;
SELECT * from cours WHERE titre like "%Data%";
SELECT COUNT(*) from formateurs; 
SELECT f.nom ,c.titre  from formateurs f INNER JOIN cours c on f.id=c.formateur_id;

SELECT e.nom ,c.titre from etudiants e INNER JOIN inscription i on e.id= i.etudiant_id INNER JOIN cours c on c.id=i.cours_id;

SELECT * from formateurs f INNER JOIN cours c ON f.id =c.formateur_id WHERE c.id in (
    SELECT c.id from etudiants e INNER JOIN inscription i on e.id= i.etudiant_id
     INNER JOIN cours c on c.id=i.cours_id  WHERE e.nom ="Jean Dupont"
)

SELECT  f.nom ,count(*)  from formateurs f INNER JOIN cours c ON f.id=c.formateur_id GROUP BY f.id
