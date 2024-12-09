<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulaire avec Validation</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f8f9fa;
            font-family: Arial, sans-serif;
            padding: 20px;
        }

        .container {
            max-width: 600px;
            margin: auto;
            background: white;
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
            color: #343a40;
        }

        .alert {
            margin-top: 20px;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Formulaire d'inscription</h1>
        <?php
        // Initialisation des variables
        $name = $prenom = $email = $password = $message = '';
        $errors = [];
        $successMessage = '';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Récupération des données POST
            $name = htmlspecialchars($_POST['name'] ?? '');
            $prenom = htmlspecialchars($_POST['prénom'] ?? '');
            $email = htmlspecialchars($_POST['email'] ?? '');
            $password = htmlspecialchars($_POST['password'] ?? '');
            $message = htmlspecialchars($_POST['message'] ?? '');

            // Chemin vers le fichier JSON
            $file = 'data.json';

            // Validation des champs
            if (empty($name)) $errors[] = 'Le champ "Nom" est obligatoire.';
            if (empty($prenom)) $errors[] = 'Le champ "Prénom" est obligatoire.';
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) $errors[] = 'L\'email est invalide.';
            if (strlen($password) < 8) $errors[] = 'Le mot de passe doit contenir au moins 8 caractères.';
            if (empty($message)) $errors[] = 'Le champ "Message" est obligatoire.';

            // Vérification des erreurs
            if (empty($errors)) {
                // Lecture du fichier JSON
                $data = file_exists($file) ? json_decode(file_get_contents($file), true) : [];

                // Vérification si le compte existe
                $existingAccount = false;
                foreach ($data as $account) {
                    if ($account['email'] === $email) {
                        $existingAccount = true;
                        break;
                    }
                }

                if ($existingAccount) {
                    $errors[] = 'Ce compte existe déjà.';
                } else {
                    // Ajout du compte
                    $newAccount = [
                        'name' => $name,
                        'prénom' => $prenom,
                        'email' => $email,
                        'password' => password_hash($password, PASSWORD_DEFAULT), // Hash du mot de passe
                        'message' => $message,
                    ];
                    $data[] = $newAccount;

                    // Enregistrement dans le fichier JSON
                    file_put_contents($file, json_encode($data, JSON_PRETTY_PRINT));

                    $successMessage = 'Compte créé avec succès !';
                    // Réinitialisation des champs
                    $name = $prenom = $email = $password = $message = '';
                }
            }
        }

        // Affichage des messages d'erreur ou de succès
        if (!empty($errors)) {
            echo '<div class="alert alert-danger"><ul>';
            foreach ($errors as $error) {
                echo "<li>$error</li>";
            }
            echo '</ul></div>';
        }

        if (!empty($successMessage)) {
            echo '<div class="alert alert-success">' . $successMessage . '</div>';
        }
        ?>
        <form method="post">
            <div class="mb-3">
                <label for="name" class="form-label">Nom</label>
                <input type="text" class="form-control" name="name" value="<?= htmlspecialchars($name) ?>" placeholder="Votre nom" required>
            </div>
            <div class="mb-3">
                <label for="prénom" class="form-label">Prénom</label>
                <input type="text" class="form-control" name="prénom" value="<?= htmlspecialchars($prenom) ?>" placeholder="Votre prénom" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" name="email" value="<?= htmlspecialchars($email) ?>" placeholder="Votre email" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Mot de passe</label>
                <input type="password" class="form-control" name="password" placeholder="Votre mot de passe" required>
            </div>
            <div class="mb-3">
                <label for="message" class="form-label">Message</label>
                <textarea class="form-control" name="message" rows="5" placeholder="Votre message"><?= htmlspecialchars($message) ?></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Envoyer</button>
        </form>
    </div>
</body>

</html>
