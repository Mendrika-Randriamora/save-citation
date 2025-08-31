<?php

require_once "./../database/database.php";

$pdo = connexion();

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["id"])) {
    extract($_GET);

    $request = "SELECT * FROM citations WHERE id = :i";

    $stmt = $pdo->prepare($request);

    $stmt->execute(["i" => $id]);

    $cite = $stmt->fetch();
} elseif ($_SERVER["REQUEST_METHOD"] == "POST") {
} else {
    header("Location: /");
    exit();
}

?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./../assets/bootstrap/bootstrap.min.css">
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
            background: linear-gradient(to bottom, rgba(0, 0, 0, 0.3) 0%, rgba(0, 0, 0, 0.7) 75%, #000 100%), url("<?= "." . $cite["pict"] ?>");
            background-position: center;
            background-repeat: no-repeat;
            background-attachment: scroll;
            background-size: cover;
        }

        .myinput {
            display: block;
            width: 100%;
            border: 1px solid white;
            padding: 10px;
            border-radius: 10px;
            background-color: rgba(0, 0, 0, 0.1);
            color: white;
        }
    </style>
    <link rel="stylesheet" href="./../assets/css/features.css">
    <title>Document</title>
</head>

<body>
    <!-- Fixed navbar -->
    <?php require_once "./../header.php" ?>

    <main>
        <div class="container">

            <form class="text-white p-3" action="" method="post">
                <div class="form-group">
                    <label for="title">The title : </label>
                    <input type="text" name="title" id="title" class="myinput" value="<?= $cite["title"] ?>">
                </div>
                <div class="form-group">
                    <label for="title">The desc : </label>
                    <input type="text" name="desc" id="desc" class="myinput" value="<?= $cite["desc"] ?>">
                </div>
                <div class="form-group">
                    <label for="pict">The pict : </label>
                    <input type="file" name="pict" id="pict" class="myinput form-floating">
                </div>
                <input type="range" value="50" class="form-range">
            </form>
        </div>
    </main>

</body>

</html>