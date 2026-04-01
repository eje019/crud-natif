<?php
require_once '../includes/header.php';

// Récupère les anciennes valeurs si le formulaire a été soumis avec des erreurs
$old = $_SESSION['old'] ?? [];
$errors = $_SESSION['errors'] ?? [];
unset($_SESSION['old'], $_SESSION['errors']);
?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="h3">Ajouter un produit</h1>
    <a href="index.php" class="btn btn-secondary">Retour à la liste</a>
</div>

<div class="card">
    <div class="card-body">
        <form action="store.php" method="POST">

            <!-- Champ Nom -->
            <div class="mb-3">
                <label for="nom" class="form-label">Nom du produit <span class="text-danger">*</span></label>
                <input
                    type="text"
                    class="form-control <?= isset($errors['nom']) ? 'is-invalid' : '' ?>"
                    id="nom"
                    name="nom"
                    value="<?= htmlspecialchars($old['nom'] ?? '') ?>"
                    placeholder="Ex : Chaise de bureau"
                >
                <?php if (isset($errors['nom'])): ?>
                    <div class="invalid-feedback"><?= $errors['nom'] ?></div>
                <?php endif; ?>
            </div>

            <!-- Champ Description -->
            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea
                    class="form-control <?= isset($errors['description']) ? 'is-invalid' : '' ?>"
                    id="description"
                    name="description"
                    rows="4"
                    placeholder="Décris le produit..."
                ><?= htmlspecialchars($old['description'] ?? '') ?></textarea>
                <?php if (isset($errors['description'])): ?>
                    <div class="invalid-feedback"><?= $errors['description'] ?></div>
                <?php endif; ?>
            </div>

            <!-- Champ Prix -->
            <div class="mb-3">
                <label for="prix" class="form-label">Prix (€) <span class="text-danger">*</span></label>
                <input
                    type="number"
                    step="0.01"
                    min="0"
                    class="form-control <?= isset($errors['prix']) ? 'is-invalid' : '' ?>"
                    id="prix"
                    name="prix"
                    value="<?= htmlspecialchars($old['prix'] ?? '') ?>"
                    placeholder="Ex : 49.99"
                >
                <?php if (isset($errors['prix'])): ?>
                    <div class="invalid-feedback"><?= $errors['prix'] ?></div>
                <?php endif; ?>
            </div>

            <button type="submit" class="btn btn-primary">Enregistrer le produit</button>

        </form>
    </div>
</div>

<?php require_once '../includes/footer.php'; ?>