<?php

require_once "./database/database.php";

$pdo = connexion();

if (!$pdo) die();

if (isset($_GET["search"]) and $_GET["search"] != "") {
    $search = "%" . $_GET["search"] . "%";
    $request = "SELECT * FROM citations WHERE title LIKE '$search' OR desc LIKE '$search'";
    $stmt = $pdo->query($request);
} else {
    $stmt = $pdo->query("SELECT * FROM citations");
}

$cites = $stmt->fetchAll();

if (count($cites) > 3)
    $body_h = "100%";
else
    $body_h = "100vh"

?><?php

    require_once "./database/database.php";

    $pdo = connexion();

    if (!$pdo) die();

    if (isset($_GET["search"]) and $_GET["search"] != "") {
        $search = "%" . $_GET["search"] . "%";
        $request = "SELECT * FROM citations WHERE title LIKE '$search' OR desc LIKE '$search'";
        $stmt = $pdo->query($request);
    } else {
        $stmt = $pdo->query("SELECT * FROM citations");
    }

    $cites = $stmt->fetchAll();

    if (count($cites) > 3)
        $body_h = "100%";
    else
        $body_h = "100vh"

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
            height: <?= $body_h ?>;
            background: linear-gradient(to bottom, rgba(0, 0, 0, 0.3) 0%, rgba(0, 0, 0, 0.7) 75%, #000 100%), url("./bg.jpg");
            background-position: 0;
            background-repeat: no-repeat;
            background-attachment: scroll;
            background-size: cover;
        }
    </style>
    <link rel="stylesheet" href="./assets/css/features.css">

    <title>Save your Cite</title>
</head>

<body>
    <!-- Fixed navbar -->
    <?php
    #$bg_color = " rgba(179, 173, 173, 1);";
    require_once "./header.php" ?>
    <main class="flex-shrink-0">
        <div class="container">


            <div class="d-flex justify-content-center">

                <div class="container row row-cols-1 row-cols-lg-3 align-items-stretch g-4 py-5">
                    <?php foreach ($cites as $cite): ?>
                        <a style="text-decoration: none;" href="show.php?view=<?= $cite["id"] ?>">
                            <div>
                                <div
                                    class="card card-cover h-100 overflow-hidden text-white bg-dark rounded-5 shadow-sm"
                                    style="background-image: url('<?= $cite["pict"] ?>')">
                                    <div
                                        class="d-flex flex-column h-100 p-5 pb-3 text-white text-shadow-1">
                                        <h2 class="pt-5 mt-5 mb-4 display-8 lh-1 fw-bold">
                                            <?= $cite["title"] ?>
                                        </h2>
                                        <ul class="d-flex list-unstyled mt-auto rounded rounded-5 p-2" style="background: rgba(200, 200, 200, 0.21);">
                                            <li class="me-auto">
                                                <img
                                                    src="porc.png"
                                                    alt="porc"
                                                    width="32"
                                                    height="32"
                                                    class="rounded-circle border border-white" />
                                            </li>
                                            <li class="d-flex align-items-center me-3">
                                                <svg class="bi me-2" width="1em" height="1em">
                                                    <use xlink:href="#geo-fill" />
                                                </svg>
                                                <small><?= $cite["author"] ?></small>
                                            </li>
                                            <li>
                                                <form action="citation/delete.php" method="post">
                                                    <input type="hidden" name="id" value="<?= $cite["id"] ?>">
                                                    <input class="btn btn-outline-danger rounded rounded-5" type="submit" value="x">
                                                </form>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </a>
                    <?php endforeach ?>
                </div>

            </div>

        </div>
    </main>
    <script src="./assets/js/bootstrap.bundle.min.js"></script>
</body>

</html>