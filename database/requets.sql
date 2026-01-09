-- Active: 1765826464238@@127.0.0.1@3306@mabagnole
drop DATABASE IF EXISTS MaBagnole;

CREATE DATABASE MaBagnole;

USE MaBagnole;

CREATE Table Utilisateurs (
    idUtilisateur int(11) PRIMARY KEY NOT NULL AUTO_INCREMENT,
    nomUtilisateur varchar(255) NOT NULL,
    prenomUtilisateur varchar(255) NOT NULL,
    telephone varchar(255) UNIQUE,
    ville varchar(255),
    email varchar(255) NOT NULL UNIQUE,
    password varchar(255) NOT NULL,
    role ENUM('admin', 'client') DEFAULT 'client',
    deleteUtilisateur INT NOT NULL DEFAULT 0,
    statusClient INT NOT NULL DEFAULT 1,
    createdAt TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    constraint check_deleteUtilisateur check (
        deleteUtilisateur between 0 and 1
    ),
    Constraint check_statusClient check (statusClient between 0 and 1)
);

CREATe Table Categories (
    idCategorie int(11) PRIMARY KEY NOT NULL AUTO_INCREMENT,
    titreCategorie varchar(255) NOT NULL,
    descriptionCategorie varchar(255) NOT NULL,
    deleteCategorie INT NOT NULL DEFAULT 0,
    constraint check_deleteCategorie check (
        deleteCategorie between 0 and 1
    )
);

CREATE table Vehicules (
    idVehicule int(11) PRIMARY KEY NOT NULL AUTO_INCREMENT,
    marqueVehicule varchar(255) NOT NULL,
    modeleVehicule varchar(255) NOT NULL,
    anneeVehicule varchar(255) NOT NULL,
    imageVehicule varchar(255) NOT NULL,
    typeBoiteVehicule ENUM('manuelle', 'automatique'),
    typeCarburantVehicule ENUM(
        'essence',
        'diesel',
        'electrique',
        'hybride'
    ),
    statusVehicule INT NOT NULL DEFAULT 1,
    couleurVehicule varchar(255) NOT NULL,
    prixVehicule DECIMAL(10, 2) NOT NULL,
    idCategorie int(11) NOT NULL,
    deleteVehicule INT NOT NULL DEFAULT 0,
    constraint check_deleteVehicule check (
        deleteVehicule between 0 and 1
    ),
    Constraint check_statusVehicule check (
        statusVehicule between 0 and 1
    ),
    FOREIGN KEY (idCategorie) REFERENCES Categories (idCategorie)
);

CREATE table Reservations (
    idReservation int(11) PRIMARY KEY NOT NULL AUTO_INCREMENT,
    dateReservation DATETIME DEFAULT CURRENT_TIMESTAMP,
    dateDebutReservation DATETIME NOT NULL,
    dateFinReservation DATETIME NOT NULL,
    lieuChange varchar(255) NOT NULL,
    idVehicule int(11) NOT NULL,
    deleteReservation INT NOT NULL DEFAULT 0,
    statusReservation ENUM(
        'confirmer',
        'en cours',
        'annuler'
    ) DEFAULT 'en cours',
    idClient int(11) NOT NULL,
    constraint check_deleteReservation check (
        deleteReservation between 0 and 1
    ),
    FOREIGN KEY (idVehicule) REFERENCES Vehicules (idVehicule),
    FOREIGN KEY (idClient) REFERENCES Utilisateurs (idUtilisateur)
);

CREATE table Option (
    idOption int(11) PRIMARY KEY NOT NULL AUTO_INCREMENT,
    titreOption varchar(255) NOT NULL,
    descriptionOption varchar(255) NOT NULL,
    prixOption DECIMAL NOT NULL,
    deleteOption INT NOT NULL DEFAULT 0,
    constraint check_deleteOption check (deleteOption between 0 and 1)
);

CREATE Table optionReservation (
    idReservation int(11) NOT NULL,
    idOption int(11) NOT NULL,
    PRIMARY KEY (idReservation, idOption),
    FOREIGN KEY (idReservation) REFERENCES Reservations (idReservation),
    FOREIGN KEY (idOption) REFERENCES Option (idOption),
    deleteOption INT NOT NULL DEFAULT 0,
    constraint check_deleteOption check (deleteOption between 0 and 1)
);

CREATE table Avis (
    idAvis int(11) PRIMARY KEY NOT NULL AUTO_INCREMENT,
    commentaireAvis varchar(255) NOT NULL,
    noteAvis int(1) NOT NULL,
    datePublicationAvis TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    idReservation int(11) NOT NULL,
    statusAvis INT NOT NULL DEFAULT 1,
    idClient int(11) NOT NULL,
    constraint check_noteAvis check (noteAvis between 1 and 5),
    constraint check_statusAvis check (statusAvis between 0 and 1),
    FOREIGN KEY (idReservation) REFERENCES Reservations (idReservation),
    FOREIGN KEY (idClient) REFERENCES Utilisateurs (idUtilisateur)
);

CREATE Table Favoris (
    idClient int(11) NOT NULL,
    idVehicule int(11) NOT NULL,
    PRIMARY KEY (idClient, idVehicule),
    FOREIGN KEY (idClient) REFERENCES Utilisateurs (idUtilisateur),
    FOREIGN KEY (idVehicule) REFERENCES Vehicules (idVehicule),
    deleteFavoris INT NOT NULL DEFAULT 0,
    constraint check_deleteFavoris check (deleteFavoris between 0 and 1)
);

CREATE Table ReagirAvis (
    idAvis int(11) NOT NULL,
    idClient int(11) NOT NULL,
    statusReagirAvis INT NOT NULL DEFAULT 1,
    PRIMARY KEY (idAvis, idClient),
    FOREIGN KEY (idAvis) REFERENCES Avis (idAvis),
    FOREIGN KEY (idClient) REFERENCES Utilisateurs (idUtilisateur),
    constraint check_statusReagirAvis check (
        statusReagirAvis between 0 and 1
    )
);

-- DROP TABLE IF EXISTS Commentaires;
-- DROP TABLE IF EXISTS AimerArticle;
-- DROP TABLE IF EXISTS ArticlesTags;
-- DROP TABLE IF EXISTS Articles;
-- drop TABLE IF EXISTS Themes;
--  DROP TABLE IF EXISTS Tags;
CREATE TABLE Themes (
    idTheme INT(11) PRIMARY KEY NOT NULL AUTO_INCREMENT,
    nomTheme VARCHAR(255) NOT NULL,
    iconTheme VARCHAR(255) NOT NULL DEFAULT 'image',
    deleteTheme INT NOT NULL DEFAULT 0,
    descriptionTheme VARCHAR(255) NOT NULL,
    constraint check_deleteTheme check (deleteTheme between 0 and 1)
);

CREATE TABLE Tags (
    idTag INT(11) PRIMARY KEY NOT NULL AUTO_INCREMENT,
    nomTag VARCHAR(255) NOT NULL,
    deleteTag INT NOT NULL DEFAULT 0,
    constraint check_deleteTag check (deleteTag between 0 and 1)
);

CREATE Table Articles (
    idArticle INT(11) PRIMARY KEY NOT NULL AUTO_INCREMENT,
    titreArticle VARCHAR(255) NOT NULL,
    contenuArticle TEXT NOT NULL,
    imageArticle VARCHAR(255) NOT NULL DEFAULT 'image',
    deleteArticle INT NOT NULL DEFAULT 0,
    statutArticle INT NOT NULL DEFAULT 0,
    datePublicationArticle TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    idTheme INT(11) NOT NULL,
    idAuteur INT(11) NOT NULL,
    constraint check_statutArticle check (statutArticle between 0 and 1),
    FOREIGN KEY (idAuteur) REFERENCES Utilisateurs (idUtilisateur),
    FOREIGN KEY (idTheme) REFERENCES Themes (idTheme)
);

CREATE Table ArticlesTags (
    idArticle INT(11) NOT NULL,
    idTag INT(11) NOT NULL,
    deleteArticlesTags INT NOT NULL DEFAULT 0,
    PRIMARY KEY (idArticle, idTag),
    FOREIGN KEY (idArticle) REFERENCES Articles (idArticle),
    FOREIGN KEY (idTag) REFERENCES Tags (idTag),
    constraint check_deleteArticlesTags check (
        deleteArticlesTags between 0 and 1
    )
);

CREATE Table AimerArticle (
    idArticle INT(11) NOT NULL,
    idClient INT(11) NOT NULL,
    PRIMARY KEY (idArticle, idClient),
    FOREIGN KEY (idArticle) REFERENCES Articles (idArticle),
    FOREIGN KEY (idClient) REFERENCES Utilisateurs (idUtilisateur)
);

CREATE table Commentaires (
    idCommentaire INT(11) PRIMARY KEY NOT NULL AUTO_INCREMENT,
    textCommentaire VARCHAR(255) NOT NULL,
    deleteCommentaire INT NOT NULL DEFAULT 0,
    dateCommentaire TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    idArticle INT(11) NOT NULL,
    idClient INT(11) NOT NULL,
    constraint check_deleteCommentaire check (
        deleteCommentaire between 0 and 1
    ),
    FOREIGN KEY (idClient) REFERENCES Utilisateurs (idUtilisateur),
    FOREIGN KEY (idArticle) REFERENCES Articles (idArticle)
);

DELIMITER / /

CREATE or REPLACE PROCEDURE aimerArticle   (in idClientl int(11), in idArticlel int(11))
BEGIN
DECLARE existe INT DEFAULT 0;
    SELECT COUNT(*) INTO existe FROM AimerArticle WHERE idClient = idClientl AND idArticle = idArticlel;
    IF (existe > 0) THEN
        DELETE FROM AimerArticle WHERE idClient = idClientl AND idArticle = idArticlel;
    ELSE
        INSERT INTO AimerArticle (idClient, idArticle) VALUES (idClientl, idArticlel);
    END IF;
END//

CREATE or REPLACE PROCEDURE supprimerTheme(in idTheme int)
BEGIN
update themes set deleteTheme=1 where idTheme=idTheme;
UPDATE articles SET deleteArticle = 1 WHERE idTheme = idTheme;
UPDATE commentaires SET deleteCommentaire = 1 WHERE idTheme = idTheme;
END//

CREATE or replace PROCEDURE supprimerTag(in idTag int)
BEGIN
update tags set deleteTag =1 where idTag=idTag;
UPDATE articlesTags SET deleteArticlesTags = 1 WHERE idTag = idTag;
END//


DELIMITER;

SELECT * FROM aimerarticle