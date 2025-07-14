<?php
require_once '../inc/fonctions.php';
session_start();

if (!isset($_SESSION['id'])) 
{
    header('Location: login.php');
    exit;
}

$ID = $_SESSION['id'];
$nom = getNom($ID);
$photo = getPhoto($ID);

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
        $emprunts[] = 
        [
            'id_objet' => $row['id_objet'],
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
  <meta charset="UTF-8" />
  <title>Accueil - Objets</title>
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body class="bg-light text-dark">

<nav class="navbar navbar-expand-lg">
  <div class="container-fluid px-3">
    <div class="d-flex align-items-center me-auto">
      <a href="deconnexion.php" class="btn btn-outline-light">Déconnexion</a>
    </div>

    <div class="d-flex align-items-center">
      <span class="username"><?= htmlspecialchars($nom) ?></span>
      <img src="../assets/upload/<?= htmlspecialchars($photo ?: 'default.jpg') ?>" alt="Profil" class="rounded-circle" width="40" height="40" />
    </div>
  </div>
</nav>

<div class="container py-5">
  <h2>Objets par catégorie</h2>

  <form method="GET" class="mb-4 d-flex align-items-center gap-3">
    <label for="categorie" class="form-label mb-0">Choisir une catégorie :</label>
    <select name="categorie" id="categorie" class="form-select w-auto d-inline-block" onchange="this.form.submit()">
      <option value="tous" <?= ($categorie === 'tous') ? 'selected' : '' ?>>Tous</option>
      <?php foreach ($categories as $cat): ?>
        <option value="<?= htmlspecialchars($cat) ?>" <?= ($categorie === $cat) ? 'selected' : '' ?>>
          <?= htmlspecialchars($cat) ?>
        </option>
      <?php endforeach; ?>
    </select>
    <a href="ajouter.php">
    <button type="button" class="btn btn-warning ms-2">
        Ajouter un objet
      </button>
    </a>
  </form>

  <?php if (!empty($emprunts)): ?>
    <div class="table-responsive shadow-sm rounded">
      <table class="table table-bordered table-hover align-middle mb-0">
        <thead class="table-dark">
          <tr>
            <th>Nom de l'objet</th>
            <th>Catégorie</th>
            <th>Propriétaire</th>
            <th>Statut</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($emprunts as $obj): ?>
            <tr>
              <td>
                <a href="fiche-objet.php?id_objet=<?= $obj['id_objet'] ?>" class="text-decoration-none">
                  <?= htmlspecialchars($obj['nom_objet']) ?>
                </a>
              </td>
              <td><?= htmlspecialchars($obj['nom_categorie']) ?></td>
              <td><?= htmlspecialchars($obj['proprietaire']) ?></td>
              <td>
                <?php if ($obj['date_retour'] === null): ?>
                  <span class="badge bg-success">Disponible</span>
                <?php else: ?>
                  <span class="badge bg-warning text-dark">
                    Emprunté jusqu'au <?= htmlspecialchars($obj['date_retour']) ?>
                  </span>
                <?php endif; ?>
              </td>
              <td>
              <?php if ($obj['date_retour'] === null): ?>
                <a href="emprunter.php?id_objet=<?= $obj['id_objet'] ?>" class="btn btn-sm btn-primary">Emprunter</a>
              <?php else: ?>
                <button class="btn btn-sm btn-secondary" disabled>Indisponible</button>
              <?php endif; ?>
            </td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  <?php elseif ($categorie !== ''): ?>
    <div class="alert alert-info">Aucun objet trouvé pour cette catégorie.</div>
  <?php endif; ?>
</div>

<script src="../bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>
