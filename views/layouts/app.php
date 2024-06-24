<?php

/**
 * Fichier de template de base
 *
 * REQUIRE
 * @var $title string : page title
 * @var $conten string : page content
 */

?>

<!DOCTYPE html>

<html lang="fr" >
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?></title>
    <link rel="stylesheet" href="./views/assets/vendors/bootstrap-5.0.2-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="./views/assets/vendors/bootstrap-5.0.2-dist/css/show-password-toggle.css">
    <link rel="stylesheet" href="./views/assets/css/style.css">
</head>

<body>
<div class="">
<!--<div class="container py-3">-->
<!--   TOFIXED  --><?php //include_once "./views/layouts/partials/header.php"; ?>

    <header>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container">
                <a class="navbar-brand" href="index.php">
                    <img src="./views/assets/img/noun-book.png" alt="" width="30" height="24"
                         class="d-inline-block align-text-top">
                    Tom Troc
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                        data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                        aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="index.php?action=welcome">accueil</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="index.php?action=books">Nos Livres à l'échanges</a>
                        </li>

                        <!--    <li class="nav-item">
                                <a class="nav-link" href="index.php?action=administration">administration</a>
                            </li>-->

                    </ul>


                    <ul class="navbar-nav mt-auto mb-2 mb-lg-0">

                        <?php if (Utils::user()) {  ?>
                            <li class="nav-item"><a href="index.php?action=messenger    " class="nav-link">messagerie</a></li>

                            <li class="nav-item">
                                <a class="nav-link" href="index.php?action=profile">mon compte</a>
                            </li>
                        <?php } ?>
                        <li class="nav-item">
                            <?php
                            if (Utils::user()) {
                               // var_dump($_SESSION['user'])// tofixed : doit etre reteste lorsqu il ny a de user en db mais connecte la fois precedente -- ne doit pas s'afficher si meme si il y a une session d'ouverte;
                                echo '<a class="nav-link" href="index.php?action=disconnectUser">Déconnexion</a>';
                            } else {
                                echo '<a class="nav-link"  href="index.php?action=connectionForm">Connexion</a>';
                            }
                            ?>
                        </li>
                    </ul>

                </div>
            </div>
        </nav>


        <h1><?= $title ?> </h1>
    </header>


    <main class="d-flex align-items-center py-4 bg-body-tertiary">
        <div class="container">
            <?= $content /* Ici est affiché le contenu réel de la page. */ ?>
        </div>
    </main>

    <footer>
        <nav>
            <ul>
                li*4>a[href="#" class=""]A générer
            </ul>
        </nav>
    </footer>
</div>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
        crossorigin="anonymous"></script>
<script src="./views/assets/vendors/bootstrap-5.0.2-dist/js/bootstrap.js" type="application/javascript"></script>

</body>
</html>