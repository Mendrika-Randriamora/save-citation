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

    if ($_FILES["pict"]["tmp_name"]) {
        $uploaddir = '/home/mendrika/Bureau/PHP/save-citation/pict/';
        $uploadfile = $uploaddir . basename($_FILES['pict']['name']);
        $file_path = './pict/' . basename($_FILES['pict']['name']);

        if (move_uploaded_file($_FILES['pict']['tmp_name'], $uploadfile)) {
            # Supprimer l'ancienne image
            $request = "SELECT pict FROM citations WHERE id = :i";

            $stmt = $pdo->prepare($request);
            $stmt->execute(["i" => $_POST["id"]]);
            $pict = $stmt->fetch()[0];
            $old_pict = "." . $pict;

            if (!unlink($old_pict)) {
                echo "Erreur de suppression de l'ancienne image";
                die();
            };

            $request = "UPDATE citations SET title = :t, author = :a, desc = :d, pict = :p, cite = :c WHERE id = :i";

            $stmt = $pdo->prepare($request);

            $stmt->execute([
                "t" => $_POST["title"],
                "a" => $_POST["author"] ?? "Unknow",
                "d" => $_POST["desc"],
                "p" => $file_path,
                "c" => $_POST["content"],
                "i" => $_POST["id"]
            ]);

            header("Location: /");
            exit();
        }
    }

    $request = "UPDATE citations SET title = :t, author = :a, desc = :d, cite = :c WHERE id = :i";
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

            <form class="text-white p-3" action="" method="post" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="title">Title:</label>
                            <input type="text" name="title" id="title" class="myinput" value="<?= htmlspecialchars($cite["title"] ?? "") ?>" required>
                        </div>
                        <div class="form-group mb-3">
                            <label for="author">Author:</label>
                            <input type="text" name="author" id="author" class="myinput" value="<?= htmlspecialchars($cite["author"] ?? "") ?>">
                        </div>
                        <div class="form-group mb-3">
                            <label for="desc">Description:</label>
                            <input type="text" name="desc" id="desc" class="myinput" value="<?= htmlspecialchars($cite["desc"] ?? "") ?>" required>
                        </div>
                        <div class="form-group mb-3">
                            <label for="pict">Image:</label>
                            <input type="file" name="pict" id="pict" class="myinput">
                            <?php if (!empty($cite["pict"])): ?>
                                <div class="mt-2">
                                    <img src="<?= '.' . $cite["pict"] ?>" alt="Current image" style="max-width: 100px; border-radius: 8px;">
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="content">Citation:</label>
                            <textarea name="content" id="content" rows="8" class="myinput" required><?= htmlspecialchars($cite["cite"] ?? "") ?></textarea>
                        </div>
                        <div class="d-flex justify-content-end pt-3">
                            <input type="hidden" name="id" value="<?= $cite["id"] ?>">
                            <input class="btn btn-primary rounded rounded-5" type="submit" value="Update">
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </main>

</body>

</html>