<div class="row">
    <div class="col-lg-6 text-center">
        <svg class="bd-placeholder-img rounded-circle" width="140" height="140" xmlns="http://www.w3.org/2000/svg"
             role="img" aria-label="Placeholder" preserveAspectRatio="xMidYMid slice" focusable="false"><title>
                Placeholder</title>
            <rect width="100%" height="100%" fill="var(--bs-secondary-color)"></rect>
        </svg>
        <h2 class="fw-normal"><?= $user->username ?></h2>
        <p>Membre depuis <?= Utils::dateIntervalDuration($user->getCreatedAt()) ?></p>
        <h5>bibliothèque</h5>
        <p><i class=""></i><?= count($books) ?> livres</p>
    </div>

    <div class="col-lg-6">
        <form action="index.php?action=suscribeUser" method="post" class="foldedCorner">

            <fieldset class="mb-3">
                <label for="email">Email address</label>
                <input type="email" class="form-control" id="email" value="<?= $user->email ?>" name="current-email" autocomplete="current-email">
            </fieldset>
            <fieldset class="mb-3 form-group">
                <label for="password">Password</label>
<!--                <input type="password" class="form-control" id="password" value="--><?php //= $user->password ?><!--"-->

                <input type="password" id="password" class="form-control rounded" value="<?= $user->password ?>" spellcheck="false" autocorrect="off" autocapitalize="off" name="current-password" autocomplete="current-password" required>
                <button id="toggle-password" type="button" class="d-none"
                        aria-label="Show password as plain text. Warning: this will display your password on the screen.">
                </button>
            </fieldset>
            <fieldset class="mb-3">
                <label for="username">Username</label>
                <input type="text" class="form-control" id="username" value="<?= $user->username ?>" spellcheck="false" autocorrect="off" autocapitalize="off" name="current-username" autocomplete="current-username" readonly\>
            </fieldset>
            <button class="btn btn-primary w-100 py-2 btn btn-success" type="submit">Modifier</button>
        </form>
    </div>

    <?php
    if (Utils::user()) {
        ?>

        <table class="adminBook">
            <tr class="articleHeaderLine">
                <th class="t-cell ">photo</th>
                <th class="t-cell ">title</th>
                <th class="t-cell ">auteur</th>
                <th class="t-cell">content</th>
                <th class="t-cell">stock</th>
                <th class="t-cell" colspan="3">actions</th>
            </tr>

            <?php
            if ($books) {
                foreach ($books as $book) {
                    ?>
                    <!--        <tr class="">-->
                    <tr class="articleLine">
                        <td class="title"><img src="<?= $book->thumb ?>"></td>
                        <td class="title"><?= $book->title ?></td>
                        <td class="content"><?php $author = $book->authors[0];
                            echo $author->fullname ?></td>
                        <td class="content"><?= $book->content ?></td>
                        <td class="content">
                            <?php
                            if ($book->stock) {
                                echo "<span class='badge rounded-pill bg-success'>disponible</span>";

                            } else {
                                echo "<span class='badge rounded-pill bg-danger'>non disponible</span>";
                            }
                            ?>
                        </td>
                        <td class="action">
                            <span class="pill rounded-pill border-danger"></span>
                            <a class="submit"
                               href="index.php?action=showUpdateBookForm&id=<?= $book->getId() ?>">
                                edit
                            </a>
                        </td>
                        <td class="action">
                            <a class="submit"
                               href="index.php?action=deleteBook&id=<?= $book->getId() ?>" <?= Utils::askConfirmation("Êtes-vous sûr de vouloir supprimer ce livre ?") ?> >delete</a>
                        </td>
                    </tr>
                <?php }
            } else {
                echo "<tr class='articleLine'>";

                echo "<td colspan='6'><p class='text-center'>Aucun livre</p></td></tr>";
                if (Utils::user()) {
                    echo "<tr class='articleLine text-center'>
                    <td colspan='6'><a class='btn btn-primary py-2 btn btn-success ' href='#/bookNew'>échanger un livre </a></td></tr>";
                }
                echo "</tr>";
            } ?>
        </table>

        <a class="submit" href="index.php?action=showUpdateBookForm">Ajouter un $book</a>


        <?php
    }
    ?>
</div>
