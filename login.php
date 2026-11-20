<?php
session_start();
require 'baza.php';

$blad = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $z = $pdo->prepare('SELECT login, haslo_hash FROM uzytkownicy WHERE login = :login');
    $z->execute(['login' => trim($_POST['login'] ?? '')]);
    $u = $z->fetch();

    if ($u && password_verify($_POST['haslo'] ?? '', $u['haslo_hash'])) {
        session_regenerate_id(true);
        $_SESSION['uzytkownik'] = $u['login'];
        header('Location: admin.php');
        exit;
    }

    $blad = 'Błędny login lub hasło.';
}
?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logowanie — Szprycha</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>
<body class="bg-light">
    <div class="container py-5" style="max-width: 420px;">
        <div class="card shadow-sm">
            <div class="card-body">
                <h1 class="h4 mb-3">Panel Szprycha — Logowanie</h1>

                <?php if ($blad !== ''): ?>
                    <div class="alert alert-danger"><?= htmlspecialchars($blad) ?></div>
                <?php endif; ?>

                <form method="post">
                    <div class="mb-3">
                        <label for="login" class="form-label">Login</label>
                        <input id="login" name="login" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="haslo" class="form-label">Hasło</label>
                        <input id="haslo" name="haslo" type="password" class="form-control" required>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Zaloguj</button>
                </form>

                <div class="mt-3 text-center">
                    <a href="index.php" class="text-decoration-none">← Powrót na stronę główną</a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>