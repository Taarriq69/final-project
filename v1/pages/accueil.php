<?php
require_once '../inc/fonctions.php';

$categorie = isset($_GET['categorie']) ? $_GET['categorie'] : 'tous';
$categories = getAllCategories();
$emprunts = [];

if ($categorie === 'tous') 
{
    $connect = dbconnect();
    $req = "SELECT * FROM vue_objets_emprunt ORDER BY nom_objet";
    $result = mysqli_query($connect, $req);
    if (!$result) 
    {
        die("Erreur SQL : " . mysqli_error($connect));
    }
    while ($row = mysqli_fetch_assoc($result)) 
    {
        $emprunts[] = [
            'nom_objet' => $row['nom_objet'],
            'nom_categorie' => $row['nom_categorie'],
            'proprietaire' => $row['proprietaire'],
            'date_retour' => $row['date_retour']
        ];
    }
} 
elseif ($categorie !== '') 
{
    $emprunts = getAllEmprunts($categorie);
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Accueil</title>
  <link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light text-dark">

<div class="container py-5">
  <h2 class="mb-4">Accueil - Objets par catégorie</h2>

  <form method="GET" class="mb-4">
    <label for="categorie" class="form-label">Choisir une catégorie :</label>
    <select name="categorie" id="categorie" class="form-select w-auto d-inline-block" onchange="this.form.submit()">
      <option value="tous" <?= ($categorie === 'tous') ? 'selected' : '' ?>>Tous</option>
      <?php foreach ($categories as $cat): ?>
        <option value="<?= htmlspecialchars($cat) ?>" <?= ($categorie === $cat) ? 'selected' : '' ?>>
          <?= htmlspecialchars($cat) ?>
        </option>
      <?php endforeach; ?>
    </select>
  </form>

  <?php if (!empty($emprunts)): ?>
    <table class="table table-bordered table-hover">
      <thead class="table-dark">
        <tr>
          <th>Nom de l'objet</th>
          <th>Catégorie</th>
          <th>Propriétaire</th>
          <th>Statut</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($emprunts as $obj): ?>
          <tr>
            <td><?= htmlspecialchars($obj['nom_objet']) ?></td>
            <td><?= htmlspecialchars($obj['nom_categorie']) ?></td>
            <td><?= htmlspecialchars($obj['proprietaire']) ?></td>
            <td>
              <?php if ($obj['date_retour'] === null): ?>
                <span class="badge bg-success">Disponible</span>
              <?php else: ?>
                <span class="badge bg-warning text-dark">Emprunté jusqu'au <?= htmlspecialchars($obj['date_retour']) ?></span>
              <?php endif; ?>
            </td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  <?php elseif ($categorie !== ''): ?>
    <div class="alert alert-info">Aucun objet trouvé pour cette catégorie.</div>
  <?php endif; ?>
</div>

</body>
</html>
