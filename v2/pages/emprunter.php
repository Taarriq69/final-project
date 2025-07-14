<?php
require_once '../inc/fonctions.php';
session_start();

if (!isset($_SESSION['id'])) 
{
    header("Location: login.php");
    exit;
}

$id_objet = $_GET['id_objet'] ?? null;
if (!$id_objet) 
{
    die("Objet non trouvé.");
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Emprunter</title>
  <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
</head>
<body class="bg-light">
<div class="container py-5">
  <h2 class="mb-4">Choisir la date de retour</h2>

  <form action="traitement-emprunt.php" method="POST" class="bg-white border p-4 rounded shadow-sm">
    <input type="hidden" name="id_objet" value="<?= htmlspecialchars($id_objet) ?>">
    
    <div class="mb-3">
      <label for="date_retour" class="form-label">Date de retour prévue :</label>
      <input type="date" name="date_retour" id="date_retour" class="form-control" required>
    </div>

    <div class="d-flex justify-content-between">
      <a href="accueil.php" class="btn btn-secondary">Annuler</a>
      <button type="submit" class="btn btn-primary">Valider l’emprunt</button>
    </div>
  </form>
</div>
</body>
</html>
