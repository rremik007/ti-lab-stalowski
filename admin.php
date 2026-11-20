<?php
require 'auth.php';
require 'baza.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $akcja = $_POST['akcja'] ?? '';

    if ($akcja === 'dodaj') {
        $nazwa = trim($_POST['nazwa'] ?? '');
        $cena = (int) ($_POST['cena'] ?? 0);

        if ($nazwa !== '' && $cena > 0) {
            $z = $pdo->prepare('INSERT INTO uslugi (nazwa, cena) VALUES (:nazwa, :cena)');
            $z->execute([
                'nazwa' => $nazwa,
                'cena' => $cena,
            ]);
            header('Location: admin.php?ok=dodano');
            exit;
        }
    }
}

$uslugi = $pdo->query('SELECT id, nazwa, cena FROM uslugi ORDER BY nazwa')->fetchAll();
?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel admina — Szprycha</title>
</head>
<body>
    <p>
        Zalogowany jako: <strong><?= htmlspecialchars($_SESSION['uzytkownik']) ?></strong> |
        <a href="index.php">Strona główna</a> |
        <a href="wyloguj.php">Wyloguj</a>
    </p>

    <h1>Panel zarządzania cennikiem</h1>

    <?php if (($_GET['ok'] ?? '') === 'dodano'): ?>
        <p style="color: green;">Usługa dodana.</p>
    <?php endif; ?>

    <h2>Aktualne usługi</h2>
    <table border="1" cellpadding="6">
        <thead>
            <tr>
                <th>Usługa</th>
                <th>Cena</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($uslugi as $usluga): ?>
                <tr>
                    <td><?= htmlspecialchars($usluga['nazwa']) ?></td>
                    <td><?= (int) $usluga['cena'] ?> zł</td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <h2>Dodaj nową usługę</h2>
    <form method="post">
        <input type="hidden" name="akcja" value="dodaj">
        <p>
            <label for="nazwa">Nazwa</label><br>
            <input id="nazwa" name="nazwa" required maxlength="100">
        </p>
        <p>
            <label for="cena">Cena (zł)</label><br>
            <input id="cena" name="cena" type="number" min="1" required>
        </p>
        <button type="submit">Dodaj</button>
    </form>
</body>
</html>