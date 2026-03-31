<?php
session_start();
require_once '../config/database.php';

// Sécurité : cette page n'accepte que les requêtes POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: index.php');
    exit;
}

// --- Récupération et nettoyage des données ---
$nom        = trim($_POST['nom'] ?? '');
$description = trim($_POST['description'] ?? '');
$price       = trim($_POST['price'] ?? '');

// --- Validation ---
$errors = [];

if (empty($nom)) {
    $errors['nom'] = 'Le nom est obligatoire.';
} elseif (strlen($nom) < 2) {
    $errors['nom'] = 'Le nom doit contenir au moins 2 caractères.';
}

if (empty($price)) {
    $errors['price'] = 'Le prix est obligatoire.';
} elseif (!is_numeric($price) || $price < 0) {
    $errors['price'] = 'Le prix doit être un nombre positif.';
}

// S'il y a des erreurs, on retourne au formulaire avec les erreurs et les anciennes valeurs
if (!empty($errors)) {
    $_SESSION['errors'] = $errors;
    $_SESSION['old']    = ['nom' => $nom, 'description' => $description, 'price' => $price];
    header('Location: create.php');
    exit;
}

// --- Insertion en base de données ---
// On utilise une requête préparée pour éviter les injections SQL
$stmt = $pdo->prepare("
    INSERT INTO produits (nom, description, prix)
    VALUES (:nom, :description, :prix)
");

$stmt->execute([
    ':nom'        => $nom,
    ':description' => $description,
    ':prix'       => $price,
]);

// Récupère l'id du produit qui vient d'être créé
$newId = $pdo->lastInsertId();

$_SESSION['success'] = 'Le produit a été ajouté avec succès.';
header("Location: show.php?id=$newId");
exit;