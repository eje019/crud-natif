<?php
require_once '../config/database.php';
require_once '../includes/header.php';

// Récupère tous les produits, du plus récent au plus ancien
$stmt = $pdo->query("SELECT * FROM products ORDER BY created_at DESC");
$products = $stmt->fetchAll();
?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="h3">Liste des produits</h1>
    <a href="create.php" class="btn btn-primary">+ Ajouter un produit</a>
</div>

<!-- Statistiques rapides -->
<div class="row mb-4">
    <div class="col-md-4">
        <div class="card text-center">
            <div class="card-body">
                <h5 class="card-title"><?= count($products) ?></h5>
                <p class="card-text text-muted">Produits au total</p>
            </div>
        </div>
    </div>
</div>

<?php if (empty($products)): ?>
    <!-- Message si aucun produit n'existe encore -->
    <div class="alert alert-info">
        Aucun produit pour l'instant.
        <a href="create.php">Créez le premier</a>.
    </div>

<?php else: ?>
    <!-- Tableau des produits -->
    <div class="card">
        <div class="card-body p-0">
            <table class="table table-hover mb-0">
                <thead class="table-dark">
                    <tr>
                        <th>#</th>
                        <th>Nom</th>
                        <th>Prix</th>
                        <th>Date d'ajout</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($products as $product): ?>
                        <tr>
                            <td><?= $product['id'] ?></td>
                            <td><?= htmlspecialchars($product['name']) ?></td>
                            <td><?= number_format($product['price'], 2, ',', ' ') ?> €</td>
                            <td><?= date('d/m/Y', strtotime($product['created_at'])) ?></td>
                            <td>
                                <a href="show.php?id=<?= $product['id'] ?>" class="btn btn-sm btn-info">Voir</a>
                                <a href="edit.php?id=<?= $product['id'] ?>" class="btn btn-sm btn-warning">Modifier</a>
                                <!-- Bouton supprimer avec confirmation -->
                                <button
                                    class="btn btn-sm btn-danger btn-delete"
                                    data-id="<?= $product['id'] ?>"
                                    data-name="<?= htmlspecialchars($product['name']) ?>"
                                >
                                    Supprimer
                                </button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Formulaire caché pour la suppression (expliqué plus bas) -->
    <form id="form-delete" action="delete.php" method="POST" style="display:none;">
        <input type="hidden" name="id" id="delete-id">
    </form>
<?php endif; ?>

<?php require_once '../includes/footer.php'; ?>