<?php
require 'baza.php';

$pdo->exec('CREATE TABLE IF NOT EXISTS uslugi (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    nazwa TEXT NOT NULL,
    cena INTEGER NOT NULL,
    popularnosc INTEGER DEFAULT 0
)');

$pdo->exec('CREATE TABLE IF NOT EXISTS uzytkownicy (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    login TEXT NOT NULL UNIQUE,
    haslo_hash TEXT NOT NULL
)');

$ileUslug = (int) $pdo->query('SELECT COUNT(*) FROM uslugi')->fetchColumn();
if ($ileUslug === 0) {
    $z = $pdo->prepare('INSERT INTO uslugi (nazwa, cena, popularnosc) VALUES (:nazwa, :cena, :popularnosc)');
    $startowe = [
        ['nazwa' => 'Przegląd', 'cena' => 120, 'popularnosc' => 45],
        ['nazwa' => 'Wymiana dętki', 'cena' => 40, 'popularnosc' => 30],
        ['nazwa' => 'Centrowanie koła', 'cena' => 60, 'popularnosc' => 15],
        ['nazwa' => 'Serwis pełny', 'cena' => 350, 'popularnosc' => 10],
    ];
    foreach ($startowe as $u) {
        $z->execute($u);
    }
}

$ileKont = (int) $pdo->query('SELECT COUNT(*) FROM uzytkownicy')->fetchColumn();
if ($ileKont === 0) {
    $z = $pdo->prepare('INSERT INTO uzytkownicy (login, haslo_hash) VALUES (:login, :hash)');
    $z->execute([
        'login' => 'admin',
        'hash' => password_hash('Szprycha!2026', PASSWORD_DEFAULT),
    ]);
}

echo "Baza gotowa.\n";