<?php
session_start();
require_once '../config/database.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: index.php');
    exit;
}

$id = (int) ($_POST['id'] ?? 0);

if ($id <= 0) {
    header('Location: index.php');
    exit;
}

$stmt = $pdo->prepare("DELETE FROM produits WHERE id = :id");
$stmt->execute([':id' => $id]);

$_SESSION['success'] = 'Le produit a été supprimé.';
header('Location: index.php');
exit;