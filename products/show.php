<?php
require_once '../config/database.php';
require_once '../includes/header.php';

// Récupère l'id passé dans l'URL (?id=3 par exemple)
$id = (int) ($_GET['id'] ?? 0);

if ($id <= 0) {
    $_SESSION['error'] = 'Produit introuvable.';
    header('Location: index.php');
    exit;
}

// Récupère le produit depuis la base
$stmt = $pdo->prepare("SELECT * FROM produits WHERE id = :id");
$stmt->execute([':id' => $id]);
$produit = $stmt->fetch();

// Si le produit n'existe pas, on retourne à la liste
if (!$produit) {
    $_SESSION['error'] = 'Ce produit n\'existe pas.';
    header('Location: index.php');
    exit;
}
?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="h3"><?= htmlspecialchars($produit['nom']) ?></h1>
    <div>
        <a href="edit.php?id=<?= $produit['id'] ?>" class="btn btn-warning">Modifier</a>
        <a href="index.php" class="btn btn-secondary">Retour</a>
    </div>
</div>

<div class="card">
    <div class="card-body">
        <dl class="row">
            <dt class="col-sm-3">Identifiant</dt>
            <dd class="col-sm-9"><?= $produit['id'] ?></dd>

            <dt class="col-sm-3">Nom</dt>
            <dd class="col-sm-9"><?= htmlspecialchars($produit['nom']) ?></dd>

            <dt class="col-sm-3">Description</dt>
            <dd class="col-sm-9">
                <?= !empty($produit['description'])
                    ? nl2br(htmlspecialchars($produit['description']))
                    : '<em class="text-muted">Aucune description</em>'
                ?>
            </dd>

            <dt class="col-sm-3">Prix</dt>
            <dd class="col-sm-9"><?= number_format($produit['prix'], 2, ',', ' ') ?> €</dd>

            <dt class="col-sm-3">Ajouté le</dt>
            <dd class="col-sm-9"><?= date('d/m/Y à H:i', strtotime($produit['created_at'])) ?></dd>

            <dt class="col-sm-3">Modifié le</dt>
            <dd class="col-sm-9"><?= date('d/m/Y à H:i', strtotime($produit['updated_at'])) ?></dd>
        </dl>
    </div>
</div>

<!-- Zone de suppression -->
<div class="mt-4 p-3 border border-danger rounded">
    <h5 class="text-danger">Zone dangereuse</h5>
    <p class="text-muted">La suppression est irréversible.</p>
    <button
        class="btn btn-danger btn-delete"
        data-id="<?= $produit['id'] ?>"
        data-name="<?= htmlspecialchars($produit['nom']) ?>"
    >
        Supprimer ce produit
    </button>
    <form id="form-delete" action="delete.php" method="POST" style="display:none;">
        <input type="hidden" name="id" id="delete-id">
    </form>
</div>

<?php require_once '../includes/footer.php'; ?> 