<?php

if ($_SERVER["REQUEST_METHOD"] != "POST") header("Location: /");

require_once "./../database/database.php";

$pdo = connexion();

if (!$pdo) die();

extract($_POST);

if (!isset($id)) header("Location: /");

$request = "SELECT pict FROM citations WHERE id = :i";

$stmt = $pdo->prepare($request);

$stmt->execute(["i" => $id]);

$pict = $stmt->fetch()[0];

$pict = "." . $pict;

if (!unlink($pict)) {
    echo "Erreur de suppression du fichier";
    die();
};

$request = "DELETE FROM citations WHERE id = $id";

$pdo->query($request);

header("Location: /");
