<?php
    /**
     * Template pour afficher une page d'erreur.
     */

    ?>

<div class="error container">
    <p class="alert alert-danger" role="alert"><?= $errorMessage ?></p>
    <p class="alert alert-danger" role="alert"><?= $errorFile ?> ligne : <?= $errorLine ?></p>

    <?php
    if ($_SESSION['redirect_url']){
         ?>
         <a href='<?= $_SESSION["redirect_url"] ?>'>Retour à la page précedente</a>
        <?php

    }else
    {
    ?>
        <a href='index.php?action=welcome'>Retour à la page d'accueil</a>;
        <?php

    }
    ?>

</div>
