<?php

if (!isset($_GET["view"])) header("Location: /");

require_once "./database/database.php";

$pdo = connexion();

$request = "SELECT * FROM citations WHERE id = :i";

$stmt = $pdo->prepare($request);

$stmt->execute(["i" => $_GET["view"]]);

$cite = $stmt->fetch();

if (!$cite) header("Location: /");

?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./assets/bootstrap/bootstrap.min.css">
    <style>
        .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            user-select: none;
        }

        @media (min-width: 768px) {
            .bd-placeholder-img-lg {
                font-size: 3.5rem;
            }
        }

        main>.container {
            padding: 60px 15px 0;
        }

        body {
            position: relative;
            width: 100%;
            height: auto;
            min-height: 35rem;
            padding: 15rem 0;
            background: linear-gradient(to bottom, rgba(0, 0, 0, 0.3) 0%, rgba(0, 0, 0, 0.7) 75%, #000 100%), url("<?= $cite["pict"] ?>");
            background-position: center;
            background-repeat: no-repeat;
            background-attachment: scroll;
            background-size: cover;
        }
    </style>
    <link rel="stylesheet" href="./assets/css/features.css">
    <title><?= $cite["title"] ?></title>
</head>

<body>
    <!-- Fixed navbar -->
    <?php require_once "./header.php" ?>

    <main class="flex-shrink-0 m-2">
        <div class="col-md-5 p-lg-5 mx-auto my-5">
            <h1 class="display-4 fw-normal text-white"> <?= $cite["title"] ?> </h1>
            <div class="lead fw-normal text-white border p-3 rounded rounded-3">
                <p>
                    <?= $cite["cite"] ?>
                </p>
                <hr>
                <div class="d-flex justify-content-end">
                    <cite style="font-size: medium;"><?= $cite["author"] ?></cite>
                </div>
            </div>
            <div class="d-flex justify-content-end pt-3">
                <a class="btn btn-outline-secondary" href="citation/update.php?id=<?= $cite["id"] ?>">Modify...</a>
            </div>
        </div>
    </main>
    <script src="./assets/js/bootstrap.bundle.min.js"></script>
</body>

</html>