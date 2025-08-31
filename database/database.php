<?php

function connexion(): ?Pdo
{
    $dsn = "sqlite:/home/mendrika/Bureau/PHP/save-citation/database/database.sqlite";
    try {
        $pdo = new PDO($dsn);

        return $pdo;
    } catch (PDOException $th) {
        echo $th->getMessage();
        die();
    }
}
