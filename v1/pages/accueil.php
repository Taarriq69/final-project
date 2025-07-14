<?php
require_once '../inc/fonctions.php'; 

$connect = dbconnect();

$sql = "SELECT * FROM vue_objets_emprunt ORDER BY nom_objet";
$result = mysqli_query($connect, $sql);

if (!$result) 
{
    die("Erreur SQL : " . mysqli_error($connect));
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Liste des objets</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container py-5">
  <h2 class="mb-4">Liste des objets disponibles & empruntés</h2>

  <table class="table table-striped table-bordered">
    <thead class="table-dark">
      <tr>
        <th>Nom de l'objet</th>
        <th>Catégorie</th>
        <th>Propriétaire</th>
        <th>Statut</th>
      </tr>
    </thead>
    <tbody>
      <?php while ($row = mysqli_fetch_assoc($result)): ?>
        <tr>
          <td><?= htmlspecialchars($row['nom_objet']) ?></td>
          <td><?= htmlspecialchars($row['nom_categorie']) ?></td>
          <td><?= htmlspecialchars($row['proprietaire']) ?></td>
          <td>
            <?php if ($row['date_retour'] === null): ?>
              <span class="badge bg-success">Disponible</span>
            <?php else: ?>
              <span class="badge bg-warning text-dark">
                Emprunté jusqu'au <?= htmlspecialchars($row['date_retour']) ?>
              </span>
            <?php endif; ?>
          </td>
        </tr>
      <?php endwhile; ?>
    </tbody>
  </table>
</div>

</body>
</html>
