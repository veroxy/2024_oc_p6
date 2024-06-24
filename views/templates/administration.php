<?php
/**
 * Affichage de la partie admin : liste des$books avec un bouton "modifier" pour chacun.
 * Et un formulaire pour ajouter un$book.
 */
?>


<table class="adminBook">
    <tr class="articleHeaderLine">
        <th class="t-cell ">photo</th>
        <th class="t-cell ">title</th>
        <th class="t-cell ">author</th>
        <th class="t-cell">stock</th>
        <th class="t-cell" colspan="3">actions</th>
    </tr>
    <?php foreach ($books as$book) { ?>
        <!--        <tr class="">-->
        <tr class="articleLine">
            <td class="title"><?=$book->thumb ?></td>
            <td class="title"><?=$book->title ?></td>
            <td class="content"><?=$book->content(200) ?></td>

            <td class="action"><span class="pill rounded-pill border-danger"></span><a class="submit"
                                  href="index.php?action=showUpdateBookForm&id=<?=$book->id ?>">edit</a>
            </td>
            <td class="action"><a class="submit"
                                  href="index.php?action=deleteBook&id=<?=$book->id ?>" <?= Utils::askConfirmation("Êtes-vous sûr de vouloir supprimer cet $book ?") ?> >delete</a>
            </td>
        </tr>
    <?php } ?>
</table>

<a class="submit" href="index.php?action=showUpdateBookForm">Ajouter un$book</a>