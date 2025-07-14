<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Connexion</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="card shadow">
                <div class="card-body">
                    <h2 class="text-center mb-4">Connexion</h2>

                    <?php if ($message): ?>
                        <div class="alert alert-danger"><?= $message ?></div>
                    <?php endif; ?>

                    <form method="POST" action="traitement-login.php">
                        <div class="mb-3">
                            <label for="email" class="form-label">Adresse Email</label>
                            <input type="email" class="form-control" name="email" required>
                        </div>

                        <div class="mb-3">
                            <label for="mdp" class="form-label">Mot de passe</label>
                            <input type="password" class="form-control" name="mdp" required>
                        </div>

                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary">Se connecter</button>
                        </div>
                    </form>

                    <div class="mt-3 text-center">
                        <a href="inscription.php">Créer un compte</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>