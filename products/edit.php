<?php
require_once '../config/database.php';
require_once '../includes/header.php';

$id = (int) ($_GET['id'] ?? 0);

if ($id <= 0) {
    header('Location: index.php');
    exit;
}

$stmt = $pdo->prepare("SELECT * FROM produits WHERE id = :id");
$stmt->execute([':id' => $id]);
$produit = $stmt->fetch();

if (!$product) {
    $_SESSION['error'] = 'Produit introuvable.';
    header('Location: index.php');
    exit;
}

// Si on revient sur le formulaire après une erreur, on préfère les vieilles valeurs saisies
$old    = $_SESSION['old'] ?? $product;
$errors = $_SESSION['errors'] ?? [];
unset($_SESSION['old'], $_SESSION['errors']);
?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="h3">Modifier : <?= htmlspecialchars($product['nom']) ?></h1>
    <a href="show.php?id=<?= $product['id'] ?>" class="btn btn-secondary">Annuler</a>
</div>

<div class="card">
    <div class="card-body">
        <form action="update.php" method="POST">
            <!-- On passe l'id du produit à modifier dans un champ caché -->
            <input type="hidden" nom="id" value="<?= $product['id'] ?>">

            <div class="mb-3">
                <label for="nom" class="form-label">Nom du produit <span class="text-danger">*</span></label>
                <input
                    type="text"
                    class="form-control <?= isset($errors['nom']) ? 'is-invalid' : '' ?>"
                    id="nom"
                    nom="nom"
                    value="<?= htmlspecialchars($old['nom']) ?>"
                >
                <?php if (isset($errors['nom'])): ?>
                    <div class="invalid-feedback"><?= $errors['nom'] ?></div>
                <?php endif; ?>
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea
                    class="form-control"
                    id="description"
                    nom="description"
                    rows="4"
                ><?= htmlspecialchars($old['description'] ?? '') ?></textarea>
            </div>

            <div class="mb-3">
                <label for="prix" class="form-label">Prix (€) <span class="text-danger">*</span></label>
                <input
                    type="number"
                    step="0.01"
                    min="0"
                    class="form-control <?= isset($errors['prix']) ? 'is-invalid' : '' ?>"
                    id="prix"
                    nom="prix"
                    value="<?= htmlspecialchars($old['prix']) ?>"
                >
                <?php if (isset($errors['prix'])): ?>
                    <div class="invalid-feedback"><?= $errors['prix'] ?></div>
                <?php endif; ?>
            </div>

            <button type="submit" class="btn btn-warning">Mettre à jour</button>
        </form>
    </div>
</div>

<?php require_once '../includes/footer.php'; ?>