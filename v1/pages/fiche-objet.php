<?php
require_once '../inc/fonctions.php';

if (!isset($_GET['id_objet']) || empty($_GET['id_objet'])) 
{
    die("Objet non trouvé.");
}

$id = intval($_GET['id_objet']);
$objet = getFicheObjet($id);
$images = getImagesObjet($id);
$historique = getHistoriqueEmprunts($id);
$imagePrincipale = count($images) > 0 ? $images[0] : "default.jpg";
?>

<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title><?= htmlspecialchars($objet['nom_objet']) ?></title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light text-dark">

<nav class="navbar navbar-dark bg-dark shadow-sm">
  <div class="container-fluid px-4">
    <a href="accueil.php" class="btn btn-outline-light">← Retour</a>
    <span class="navbar-text text-warning fw-bold ms-auto">
      Détails de l'objet
    </span>
  </div>
</nav>

<div class="container py-5">
  <h2 class="mb-4"><?= htmlspecialchars($objet['nom_objet']) ?></h2>

  <div class="row mb-4">
    <div class="col-md-6 mb-3">
      <img src="<?= htmlspecialchars($imagePrincipale) ?>" class="img-fluid rounded border w-100" alt="Image principale">
    </div>
    <div class="col-md-6">
      <p><strong>Catégorie :</strong> <?= htmlspecialchars($objet['nom_categorie']) ?></p>
      <p><strong>Propriétaire :</strong> <?= htmlspecialchars($objet['proprietaire']) ?></p>

      <?php if (count($images) > 1): ?>
        <div class="mt-3">
          <h5>Autres images :</h5>
          <div class="d-flex flex-wrap">
            <?php foreach (array_slice($images, 1) as $img): ?>
              <img src="<?= htmlspecialchars($img) ?>" width="80" class="me-2 mb-2 border rounded">
            <?php endforeach; ?>
          </div>
        </div>
      <?php endif; ?>
    </div>
  </div>

  <h4>Historique des emprunts</h4>
  <?php if (!empty($historique)): ?>
    <div class="table-responsive">
      <table class="table table-bordered">
        <thead class="table-dark">
          <tr>
            <th>Emprunteur</th>
            <th>Date d'emprunt</th>
            <th>Date de retour</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($historique as $h): ?>
            <tr>
              <td><?= htmlspecialchars($h['emprunteur']) ?></td>
              <td><?= htmlspecialchars($h['date_emprunt']) ?></td>
              <td><?= htmlspecialchars($h['date_retour']) ?: 'Non rendu' ?></td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  <?php else: ?>
    <div class="alert alert-info">Aucun emprunt enregistré pour cet objet.</div>
  <?php endif; ?>
</div>

<script src="../bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>
