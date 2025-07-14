<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Inscription</title>
  <link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light text-dark">

<div class="container py-5">
  <div class="row justify-content-center">
    <div class="col-md-7 col-lg-6">

      <div class="card bg-light border-warning shadow-sm">
        <div class="card-body">

          <h2 class="text-center text-warning mb-4">Créer un compte</h2>

          <?php if (isset($_GET['message'])): ?>
            <div class="alert alert-info"><?= htmlspecialchars($_GET['message']) ?></div>
          <?php endif; ?>

          <form method="POST" action="traitement-inscription.php" enctype="multipart/form-data">
            <div class="mb-3">
              <label for="nom" class="form-label">Nom complet</label>
              <input type="text" class="form-control border-warning" name="nom" required>
            </div>

            <div class="mb-3">
              <label for="date_naissance" class="form-label">Date de naissance</label>
              <input type="date" class="form-control border-warning" name="date_naissance" required>
            </div>

            <div class="mb-3">
              <label class="form-label">Genre</label>
              <select class="form-select border-warning" name="genre" required>
                <option value="">-- Choisir --</option>
                <option value="Homme">Homme</option>
                <option value="Femme">Femme</option>
                <option value="Autre">Autre</option>
              </select>
            </div>

            <div class="mb-3">
              <label for="email" class="form-label">Adresse e-mail</label>
              <input type="email" class="form-control border-warning" name="email" required>
            </div>

            <div class="mb-3">
              <label for="ville" class="form-label">Ville</label>
              <input type="text" class="form-control border-warning" name="ville">
            </div>

            <div class="mb-3">
              <label for="mdp" class="form-label">Mot de passe</label>
              <input type="password" class="form-control border-warning" name="mdp" required>
            </div>

            <div class="d-grid mb-3">
              <button type="submit" class="btn btn-warning text-dark fw-bold">S'inscrire</button>
            </div>

            <div class="text-center">
              <small>Déjà un compte ? <a href="login.php" class="text-warning fw-semibold">Se connecter</a></small>
            </div>
          </form>

        </div>
      </div>

    </div>
  </div>
</div>

</body>
</html>
