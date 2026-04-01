<?php
session_start();
require_once '../config/database.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: index.php');
    exit;
}

$id         = (int) ($_POST['id'] ?? 0);
$nom        = trim($_POST['nom'] ?? '');
$description = trim($_POST['description'] ?? '');
$prix       = trim($_POST['prix'] ?? '');

// Vérifie que le produit existe
$stmt = $pdo->prepare("SELECT id FROM produits WHERE id = :id");
$stmt->execute([':id' => $id]);
if (!$stmt->fetch()) {
    $_SESSION['error'] = 'Produit introuvable.';
    header('Location: index.php');
    exit;
}

// Validation
$errors = [];

if (empty($nom)) {
    $errors['nom'] = 'Le nom est obligatoire.';
}

if (empty($prix) || !is_numeric($prix) || $prix < 0) {
    $errors['prix'] = 'Le prix doit être un nombre positif.';
}

if (!empty($errors)) {
    $_SESSION['errors'] = $errors;
    $_SESSION['old']    = ['nom' => $nom, 'description' => $description, 'prix' => $prix];
    header("Location: edit.php?id=$id");
    exit;
}

// Mise à jour en base
$stmt = $pdo->prepare("
    UPDATE produits
    SET nom = :nom, description = :description, prix = :prix
    WHERE id = :id
");

$stmt->execute([
    ':nom'        => $nom,
    ':description' => $description,
    ':prix'       => $prix,
    ':id'          => $id,
]);

$_SESSION['success'] = 'Le produit a été modifié avec succès.';
header("Location: show.php?id=$id");
exit;