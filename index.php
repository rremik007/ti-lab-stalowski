<?php
$firma = 'Szprycha';
$rok = date('Y');

$cennik = [
    ['nazwa' => 'Centrowanie koła', 'cena' => 40],
    ['nazwa' => 'Wymiana dętki / opony', 'cena' => 25],
    ['nazwa' => 'Odpowietrzanie hamulców', 'cena' => 60],
    ['nazwa' => 'Regulacja przerzutek', 'cena' => 35],
    ['nazwa' => 'Smarowanie i czyszczenie napędu', 'cena' => 50],
];
?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Szprycha - Pracownia Rowerowa</title>
    <script src="app.js" defer></script>
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <header class="site-header">
        <p class="logo">Szprycha</p>
        <button class="menu-toggle" aria-expanded="false" aria-label="Menu">☰ Menu</button>
        <nav class="menu">
            <a href="#uslugi">Usługi</a>
            <a href="#cennik">Cennik</a>
            <a href="#kontakt">Kontakt</a>
        </nav>
    </header>

    <main>
        <section id="uslugi">
            <h2>Nasze usługi</h2>
            <div class="cards">
                <article class="card">
                    <h3>Przegląd podstawowy</h3>
                    <p>Sprawdzenie stanu technicznego, regulacja przerzutek i hamulców, smarowanie łańcucha.</p>
                    <p class="card_price">od 120 zł</p>
                </article>
                <article class="card card--highlight">
                    <h3>Przegląd rozszerzony</h3>
                    <p>Kompleksowe mycie, centrowanie kół, regulacja napędu i pełne smarowanie.</p>
                    <p class="card_price">od 250 zł</p>
                </article>
                <article class="card">
                    <h3>Serwis amortyzatora</h3>
                    <p>Czyszczenie, wymiana oleju i uszczelek w widelcach przednich oraz damperach.</p>
                    <p class="card_price">od 180 zł</p>
                </article>
            </div>
        </section>

        <section id="cennik">
            <h2>Cennik szczegółowy</h2>
            <table class="price-table">
                <thead>
                    <tr>
                        <th>Usługa</th>
                        <th class="num">Cena</th>
                    </tr>
                </thead>
                <tbody>
<?php foreach ($cennik as $usluga): ?>
    <tr>
        <td><?= htmlspecialchars($usluga['nazwa']) ?></td>
        <td class="num"><?= $usluga['cena'] ?> zł</td>
    </tr>
<?php endforeach; ?>
</tbody>
            </table>
        </section>
    </main>

    <footer id="kontakt">
    <p>Pracownia Rowerowa Szprycha</p>
    <p>&copy; <?= $rok ?> <?= $firma ?></p>
    <p>ul. Rowerowa 12, 85-001 Bydgoszcz</p>
    <p>Telefon: <a href="tel:+48500100200">500 100 200</a></p>
    <p>Email: <a href="mailto:serwis@szprycha.pl">serwis@szprycha.pl</a></p>
</footer>

</body>
</html>