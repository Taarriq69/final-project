<?php
require ('../inc/fonctions.php');
$categorie = $_GET['categorie'] ?? 'tous';
$categories = getAllCategories();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8" />
  <title>Ajouter un objet</title>
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet" />
</head>
<body class="bg-light text-dark">

<nav class="navbar navbar-dark bg-dark shadow-sm mb-4">
  <div class="container">
    <a href="accueil.php" class="navbar-brand">
      ← Retour à l'accueil
    </a>
    <span class="navbar-text text-warning fw-bold">
      Ajouter un objet
    </span>
  </div>
</nav>

<div class="container">
  <h2 class="mb-4 text-center">Ajouter un nouvel objet</h2>

  <form method="POST" enctype="multipart/form-data" action="traitement-ajout.php" class="p-4 bg-white border rounded shadow-sm">
    
    <div class="mb-3">
      <label for="nom" class="form-label">Nom de l'objet</label>
      <input type="text" class="form-control" id="nom" name="nom" required>
    </div>

    <div class="mb-3">
      <label for="images" class="form-label">Images de l'objet</label>
      <input type="file" name="images[]" id="images" class="form-control" accept="image/*" multiple>
      <small class="text-muted">Vous pouvez sélectionner plusieurs fichiers</small>
    </div>

    <div class="mb-3">
      <label for="categorie" class="form-label">Catégorie</label>
      <select name="categorie" id="categorie" class="form-select" required>
        <option value="" disabled selected>-- Choisir une catégorie --</option>
        <?php foreach ($categories as $cat): ?>
          <option value="<?= htmlspecialchars($cat) ?>" <?= ($categorie === $cat) ? 'selected' : '' ?>>
            <?= htmlspecialchars($cat) ?>
          </option>
        <?php endforeach; ?>
      </select>
    </div>

    <div class="d-flex justify-content-between">
      <a href="accueil.php" class="btn btn-secondary">← Retour</a>
      <button type="submit" class="btn btn-warning text-dark fw-bold">Enregistrer</button>
    </div>

  </form>
</div>

</body>
</html>
