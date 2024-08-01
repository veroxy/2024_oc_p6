<?php
    /**
     * Template pour afficher une page d'erreur.
     */

    ?>

<div class="error container">
    <p class="alert alert-danger" role="alert"><?= $errorMessage ?></p>
    <p class="alert alert-danger" role="alert"><?= $errorFile ?> ligne : <?= $errorLine ?></p>
<!--    <p class="alert alert-primary" role="alert">--><?php //= var_dump($error) ?><!-- </p>-->
    <a href="index.php?action=welcome">Retour à la page d'accueil</a>
</div>
