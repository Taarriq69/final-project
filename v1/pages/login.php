<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Connexion</title>
    <link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light text-dark">

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-6 col-lg-5">

            <div class="card bg-light border-warning shadow-sm">
                <div class="card-body">

                    <h2 class="text-center text-warning mb-4">Connexion</h2>

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
                            <button type="submit" class="btn btn-warning text-dark fw-bold">Se connecter</button>
                        </div>
                    </form>

                    <div class="mt-3 text-center">
                        <small>Pas encore de compte ? <a href="inscription.php" class="text-warning fw-semibold">S'inscrire</a></small>
                    </div>

                </div>
            </div>

        </div>
    </div>
</div>

</body>
</html>
