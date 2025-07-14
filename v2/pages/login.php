<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Connexion</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light text-dark">

<!-- Header sombre -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow-sm">
  <div class="container-fluid px-4">
    <a class="navbar-brand fw-bold text-warning" href="#">Lend</a>
    <div class="ms-auto">
      <a href="inscription.php" class="btn btn-outline-light fw-semibold">S'inscrire</a>
    </div>
  </div>
</nav>

<!-- Contenu -->
<div class="container py-5">
  <div class="row justify-content-center">
    <div class="col-sm-10 col-md-8 col-lg-5">
      <div class="card border-0 shadow-sm">
        <div class="card-body p-4">

          <h3 class="text-center text-warning fw-bold mb-4">Se connecter</h3>

          <?php if (isset($message) && $message): ?>
            <div class="alert alert-danger"><?= htmlspecialchars($message) ?></div>
          <?php endif; ?>

          <form method="POST" action="traitement-login.php">
            <div class="mb-3">
              <label for="email" class="form-label">Adresse Email</label>
              <input type="email" class="form-control border-warning" name="email" required>
            </div>

            <div class="mb-3">
              <label for="mdp" class="form-label">Mot de passe</label>
              <input type="password" class="form-control border-warning" name="mdp" required>
            </div>

            <div class="d-grid mb-3">
              <button type="submit" class="btn btn-warning fw-bold text-dark">Connexion</button>
            </div>
          </form>

          <div class="text-center">
            <small>Pas encore de compte ? <a href="inscription.php" class="text-warning fw-semibold">Créer un compte</a></small>
          </div>

        </div>
      </div>
    </div>
  </div>
</div>

<script src="../bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>
