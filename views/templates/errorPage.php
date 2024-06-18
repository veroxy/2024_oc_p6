<?php
    /**
     * Template pour afficher une page d'erreur.
     */
?>

<div class="error">
    <h2><?= $title ?></h2>
    <p class="alert alert-danger" role="alert"><?= $errorMessage ?></p>
    <a href="index.php?action=welcome">Retour à la page d'accueil</a>
</div>
