<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    require_once "./../database/database.php";

    $pdo = connexion();

    if (!$pdo) die();


    $uploaddir = '/home/mendrika/Bureau/PHP/save-citation/pict/';
    $uploadfile = $uploaddir . basename($_FILES['pict']['name']);
    $file_path = './pict/' . basename($_FILES['pict']['name']);

    if (move_uploaded_file($_FILES['pict']['tmp_name'], $uploadfile)) {


        $stmt = $pdo->prepare("INSERT INTO citations(title, author, desc, pict, cite) VALUES (:t, :a, :d, :p, :c)");

        $stmt->execute([
            "t" => $_POST["title"],
            "a" => $_POST["author"] ?? "Unknow",
            "d" => $_POST["desc"],
            "p" => $file_path,
            "c" => $_POST["content"]
        ]);

        header("Location: /");
    }
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
    </style>
    <link rel="stylesheet" href="./../assets/css/features.css">
    <title>Create yours</title>
</head>

<body class="d-fle justify-content-center">
    <?php
    $bg_color = " rgba(179, 173, 173, 1);";
    require_once "./../header.php" ?>

    <main>


        <div class="container">
            <div class="title text-center">
                <h2>
                    Create your cite now
                </h2>
            </div>
            <form class="d-flex justify-content-center" action="" method="post" enctype="multipart/form-data">
                <div class="d-flex">
                    <div class="p-3">
                        <div class="form-group">
                            <label for="content">The title : </label>
                            <input type="input" name="title" id="title" class="form-control" required>
                        </div>
                        <div class=" form-group">
                            <label for="author">Author : </label>
                            <input
                                class="form-control" type="text" style="height: 40px;"
                                name="author" id="author"
                                placeholder="ex: Marc">
                        </div>
                        <div class="form-group">
                            <label for="content">The description : </label>
                            <input type="input" name="desc" id="desc" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="content">The pict : </label>
                            <input type="file" name="pict" id="pict" class="form-control" required>
                        </div>

                    </div>
                    <div class="p-3">
                        <div class="form-group">
                            <label for="content">The cite : </label>
                            <textarea class="form-control  rounded rounded-3" name="content" rows="10" cols="50" id="content" required></textarea>
                        </div>
                        <div class="d-flex justify-content-center pt-4">
                            <input class="w-100 btn btn-primary rounded rounded-5" type="submit" value="Create">
                        </div>
                    </div>
                </div>
            </form>

        </div>

    </main>
    <script src="./../assets/js/bootstrap.bundle.min.js"></script>
</body>

</html>