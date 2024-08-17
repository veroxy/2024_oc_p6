<?php

/**
 * Fichier de template de base
 *
 * REQUIRE
 * @var $title string : page title
 * @var $conten string : page content
 */
$showTitle = $_SESSION['show-title'];
$action    = Utils::request('action');
//TOFIXED

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?></title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Playfair+Display:ital,wght@0,400..900;1,400..900&display=swap"
          rel="stylesheet">
    <link rel="stylesheet" href="./views/assets/css/mybs-5.css">
    <link rel="stylesheet" href="./views/assets/vendors/bootstrap-5.0.2-src/dist/css/show-password-toggle.css">
    <link rel="stylesheet" href="./views/assets/css/style.css">
</head>

<body class="<?= $showTitle ? 'bg-beige' : 'bg-beige-light' ?>">
<div class="">
    <!--<div class="container py-3">-->
    <!--   TOFIXED  --><?php //include_once "./views/layouts/partials/header.php"; ?>

    <header>
        <nav class="navbar navbar-expand-lg navbar-light bg-secondary">
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
                    </ul>


                    <ul class="navbar-nav mt-auto mb-2 mb-lg-0">

                        <?php if (Utils::user()) { ?>
                            <li class="nav-item">
                                <a href="index.php?action=messenger"
                                   class="nav-link"><i class="fa"></i>
                                    messagerie
                                </a></li>

                            <li class="nav-item">
                                <a class="nav-link" href="index.php?action=profile">mon compte</a>
                            </li>
                        <?php } ?>

                        <li class="nav-item">
                            <?php
                            if (Utils::user()) {
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

    </header>

    <main class="d-flex align-items-center py-4 <?= $showTitle ? 'bg-beige' : 'bg-beige-light' ?>">
        <div class="container <?= !in_array($action, ['book', 'messenger']) ? 'col-md-8' : '' ?>">
            <div class="d-flex flex-wrap">
                <?php if (!$showTitle) { ?>
                    <h1 class="col-md-6 link-dark" id="page-title"><?= $title ?></h1>
                <?php } ?>
                <?= $content /* Ici est affiché le contenu réel de la page. */ ?>
            </div>
        </div>
    </main>

    <footer class="d-flex align-items-center py-4 bg-secondary position-fixed bottom-0 text-body-secondary py-3 w-100">
        <nav class="container align-content-end justify-content-end">
            <ul class="d-sm-flex justify-content-end list-group-item list-unstyled g-2">
                <li class="d-flex justify-content-center"><a href="#" class="link-dark">Politique de confidentialité</a>
                </li>
                <li class="d-flex justify-content-center"><a href="#" class="link-dark">Mentions légales</a></li>
                <li class="d-flex justify-content-center"><a href="#" class="link-dark">Tom Troc©</a></li>
                <li class="d-flex justify-content-center"><a href="#" class="link-dark">LOGO</a></li>
            </ul>
        </nav>
    </footer>
</div>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
        crossorigin="anonymous"></script>
<script src="./views/assets/vendors/bootstrap-5.0.2-src/dist/js/bootstrap.js" type="application/javascript"></script>

<script type="application/javascript" src="./views/assets/js/ajax.js"></script>

<?php
// uniquement pour la page messagerie
if ($action == "messenger") {
    ?>
    <script type="application/javascript" src="./views/assets/js/messenger.js"></script>
    <script type="application/javascript">
        if (document.readyState === "loading") {
            document.addEventListener(("DOMContentLoaded"), ftx_getContact);
            console.log('ON LOAD')
        } else {
            ftx_getContact();
            console.log('LOADED')
        }

        /* ajax.get('index.php?action=getCurrentSender&sender=', {senderIdAx: 'bar'}, function () {
         });
         */

        let url      = 'index.php?action=getCurrentSender&sender='.<?= isset($contact) ? $contact->getId() : 'null' ?>;
        let data     = {}
        let callback = null;
        ajax.get     = function (url, data, callback, async) {
            let query = [];
            for (var key in data) {
                query.push(encodeURIComponent(key) + '=' + encodeURIComponent(data[key]));
            }
            ajax.send(url + (query.length ? '?' + query.join('&') : ''), callback, 'GET', null, async)
        };

        ajax.post = function (url, data, callback, async) {
            let query = [];
            for (var key in data) {
                query.push(encodeURIComponent(key) + '=' + encodeURIComponent(data[key]));
            }
            ajax.send(url, callback, 'POST', query.join('&'), async)
        };

    </script>
    <?php
}

if ($action == "books") {
    ?>
    <script type="application/javascript">
        if (document.readyState === "loading") {
            document.addEventListener(("DOMContentLoaded"), ftx_getContact);
            console.log('ON LOAD')
        } else {
            ftx_getContact();
            console.log('LOADED')
        }


    </script>
    <?php
}
?>
</body>
</html>