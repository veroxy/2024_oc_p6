<header>

    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="index.php">
                <img src="./..//assets/vendors/5.0/assets/brand/bootstrap-logo.svg" alt="" width="30" height="24"
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

                    <?php if (isset($_SESSION['user'])) { ?>
                        <li class="nav-item"><a href="#" class="nav-link">messagerie</a></li>

                        <li class="nav-item">
                            <a class="nav-link" href="index.php?action=profile">mon compte</a>
                        </li>
                    <?php } ?>
                    <li class="nav-item">
                        <?php
                        if (isset($_SESSION['user'])) {
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


    <h1><?= $title ?></h1>
</header>
