<?php
require_once '../inc/fonctions.php';
session_start();

$ID = $_SESSION['id'];
$nom= getNom($ID);
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
  <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body class="bg-light text-dark">

<nav class="navbar navbar-expand-lg bg-warning bg-gradient shadow-sm mb-5">
  <div class="container">
    <a class="navbar-brand fw-bold text-dark" href="profil.php.php"><?php echo $nom ?></a>
    <button class="navbar-toggler text-dark" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link fw-semibold text-dark" href="deconnexion.php">Déconnexion</a>
        </li>
      </ul>
    </div>
  </div>
</nav>

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
