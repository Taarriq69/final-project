<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Connexion</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-dark text-light">

<nav class="navbar navbar-expand-lg bg-warning bg-gradient shadow-sm mb-5">
  <div class="container">
    <a class="navbar-brand fw-bold text-dark" href="#">Lend</a>
    <button class="navbar-toggler text-dark" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link fw-semibold text-dark" href="inscription.php">S'inscrire</a>
        </li>
      </ul>
    </div>
  </div>
</nav>

<div class="container">
  <div class="row justify-content-center">
    <div class="col-sm-10 col-md-8 col-lg-5">
      <div class="card bg-secondary text-light border-0 shadow-lg">
        <div class="card-body p-4">

          <h3 class="text-center text-warning fw-bold mb-4">Se connecter</h3>

          <?php if (isset($message) && $message): ?>
            <div class="alert alert-danger"><?= htmlspecialchars($message) ?></div>
          <?php endif; ?>

          <form method="POST" action="traitement-login.php">
            <div class="mb-3">
              <label for="email" class="form-label">Adresse Email</label>
              <input type="email" class="form-control bg-dark text-light border-warning" name="email" required>
            </div>

            <div class="mb-3">
              <label for="mdp" class="form-label">Mot de passe</label>
              <input type="password" class="form-control bg-dark text-light border-warning" name="mdp" required>
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
