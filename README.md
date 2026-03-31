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