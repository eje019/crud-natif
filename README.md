## CRUD en PHP natif, HTML, CSS et JS

De zero jusqu'a la fin

Ce guide montre comment créer un système de gestion complet (_ajouter, afficher, modifier, supprimer des données_) sans aucun framework.

Pour l'exemple on va construire une application de _gestion de produits_, étape par étape.

## Ce qu'on va construire

Une mini-application web avec ces pages :

- Une page d'accueil qui liste tous les produits
- Une page pour ajouter un produit
- Une page pour voir le détail d'un produit
- Une page pour modifier un produit
- La suppression d'un produit (sans page dédiée)

## Prérequis

Avoir installé sur son ordinateur :

- XAMPP (ou WAMP sur Windows) — il contient Apache, PHP et MySQL en un seul paquet
- Un éditeur de code comme VS Code
- Un navigateur web

## Structure des fichiers du projet

Voici comment on va organiser les fichiers :

## Structure du projet

```
crud/
│
├── config/
│   └── database.php        # Connexion à la base de données
│
├── includes/
│   ├── header.php          # En-tête commune à toutes les pages
│   └── footer.php          # Pied de page commun
│
├── products/
│   ├── index.php           # Liste tous les produits
│   ├── create.php          # Formulaire d'ajout
│   ├── store.php           # Traitement de l'ajout
│   ├── show.php            # Détail d'un produit
│   ├── edit.php            # Formulaire de modification
│   ├── update.php          # Traitement de la modification
│   └── delete.php          # Traitement de la suppression
│
├── assets/
│   ├── css/
│   │   └── style.css       # Styles personnalisés
│   └── js/
│       └── app.js          # Scripts JavaScript
│
└── index.php               # Page d'accueil (redirige vers products/)
```

Il faut placer ce dossier crud dans le dossier htdocs de XAMPP (explorateur de fichiers-> dossier de XAMP -> dossier htdocs)

OK ON EST BONS.

## 1 - CREATION DE LABASE DE DONNEES

- D'abord il faut ouvrir son navigateur et aller sur http://localhost/phpmyadmin (il y a la page d'accueil de xamp la)

- Ensuite il faut creer une base de domnnee appelee par exemple crud et apres ca aller dans l'onglet SQL et executer la requete qui suit :

CREATE TABLE Produits (
id INT AUTO_INCREMENT PRIMARY KEY,
nom VARCHAR(255) NOT NULL,
description TEXT,
prix DECIMAL(10, 2) NOT NULL,
created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

C'est un requete simple pour creer une table Produits dans la base de donnees crud (ou tout autre nom ca depend) avec :

- id — un numéro unique attribué automatiquement à chaque produit
- nom — le nom du produit
- description — une description du produit
- prix — le prix
- created_at et updated_at — les dates de création et modification, remplies automatiquement

## PARTIES DES FICHIERS

- ## FICHIER config/database.php :
  C'est le 1er dans lequel on ecrit. On vas l'inclure dans toutes les pages qui ONT BESOIN D'ACCEDER A LA BASE DE DONNEES. On utilise PDO (cest une facon moderne et securisee de communiquer avec MySQL en PHP)

Voir : /config/database.php
Ce fichier ne fait qu'une chose la connexion a MySQL 
Dans ce fichier la il doit y avoir :
- Les informations de connexion a la base de donnees : le nom de la base de donnees ; le nom du serveur (XAMP utilise localhost); l'utilisateur par defaut de XAMP et son mot de passe sur xamp.

- On utilise try...catch pour capturer les erreurs :
_Dans le try {} :_
- On cree la connexion avec PDO (PDO c'est le PHP Data Object, la facon securisee de parler a MySQL)
- On demande a PDO de signaler toutes les erreurs SQL 
- On dit enfin a PDO de nous retourner les resultats sous forme de tableau associatif : cle -> valeur
_Dans le catch() {} :_
- Si la connexion a la BDD echoue on affiche un messsage et on arrete tout 

