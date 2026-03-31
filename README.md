## CRUD en PHP natif, HTML, CSS et JS
De zero jusqu'a la fin

Ce guide montre comment créer un système de gestion complet (*ajouter, afficher, modifier, supprimer des données*) sans aucun framework. 

Pour l'exemple on va construire une application de *gestion de produits*, étape par étape.

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

crud/
│
├── config/
│   └── database.php        ← connexion à la base de données
│
├── includes/
│   ├── header.php          ← en-tête commune à toutes les pages
│   └── footer.php          ← pied de page commun
│
├── products/
│   ├── index.php           ← liste tous les produits
│   ├── create.php          ← formulaire d'ajout
│   ├── store.php           ← traitement de l'ajout
│   ├── show.php            ← détail d'un produit
│   ├── edit.php            ← formulaire de modification
│   ├── update.php          ← traitement de la modification
│   └── delete.php          ← traitement de la suppression
│
├── assets/
│   ├── css/
│   │   └── style.css       ← styles personnalisés
│   └── js/
│       └── app.js          ← scripts JavaScript
│
└── index.php               ← page d'accueil (redirige vers products/)