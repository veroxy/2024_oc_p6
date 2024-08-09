<div class="d-flex w-100 <?= Utils::user() && $user->getId() == $currentUser->getId() ? 'flex-column' : '' ?>">
    <div class="d-flex <?= Utils::user() && $user->getId() == $currentUser->getId() ? '' : 'col-md-6'?> ">

        <div class="text-center bg-white rounded p-5 <?= Utils::user() && $user->getId() == $currentUser->getId() ? 'col-md-6' : 'col-md-12'?>">

            <div>
                <img class="bd-placeholder-img rounded-circle" src="<?= $user->getThumb() ?>">
            </div>
            <h2 class="fw-normal"><?= $user->getUsername() ?></h2>
            <p>Membre depuis <?= Utils::dateIntervalDuration($user->getCreatedAt()) ?></p>
            <h5 class="t-8">bibliothèque</h5>
            <p><i class=""></i><?= is_int($books) ? $books : count($books) ?> livres</p>
            <?php if (Utils::user() && $user->getId() !== $currentUser->getId() || !Utils::user()) { ?>
                <a href="index.php?action=messenger&sender=<?= $user->getId() ?>" class="btn btn-success"><?php ?>envoyer un
                    message</a>
                <?php
            }
            ?>
        </div>
        <?php if (Utils::user() && $user->getId() == $currentUser->getId()) {
          ?>
            <div class="col-md-6 bg-white rounded">
                <form action="index.php?action=updateUser" method="post" class="foldedCorner">

                    <fieldset class="mb-3">
                        <label for="email">Email address</label>
                        <input type="email" class="form-control" id="email" value="<?= $user->getEmail() ?>"
                               name="current-email"
                               autocomplete="current-email">
                    </fieldset>
                    <fieldset class="mb-3 form-group">
                        <label for="password">Password</label>
                        <!--                <input type="password" class="form-control" id="password" value="-->
                        <?php //= $user->password ?><!--"-->

                        <input type="password" id="password" class="form-control rounded" value="<?= $user->getPassword() ?>"
                               spellcheck="false" autocorrect="off" autocapitalize="off" name="current-password"
                               autocomplete="current-password" required>
                        <button id="toggle-password" type="button" class="d-none"
                                aria-label="Show password as plain text. Warning: this will display your password on the screen.">
                        </button>
                    </fieldset>
                    <fieldset class="mb-3">
                        <label for="username">Username</label>
                        <input type="text" class="form-control" id="username" value="<?= $user->getUsername() ?>"
                               spellcheck="false"
                               autocorrect="off" autocapitalize="off" name="current-username"
                               autocomplete="current-username"
                               readonly\>
                    </fieldset>
                    <button class="btn btn-primary w-100 py-2 btn btn-success" type="submit">Modifier</button>
                </form>
            </div>
            <?php
        }
        ?>

    </div>
    <?php
    if (Utils::user() && $user->getId() == $currentUser->getId()) {
        echo '<table class="adminBook col">';
    } else {
    ?>
    <table class="adminBook <?= Utils::user() && $user->getId() == $currentUser->getId() ? 'col-lg-6' : ''?>">

        <?php
        }
        ?>

        <tr class="articleHeaderLine">
            <th class="t-cell text-center text-uppercase">photo</th>
            <th class="t-cell text-center text-uppercase">title</th>
            <th class="t-cell text-center text-uppercase">auteur</th>
            <th class="t-cell text-center text-uppercase">content</th>
            <?php if (Utils::user() && $user->getId() == $currentUser->getId()) { ?>
                <th class="t-cell text-center text-uppercase">stock</th>
                <th class="t-cell text-center text-uppercase" colspan="3">actions</th>
            <?php } ?>
        </tr>

        <?php
        if ($books) {
            foreach ($books as $book) {
                ?>
                <!--        <tr class="">-->
                <tr class="articleLine">
                    <td class="title book-card">
                        <img src="<?= $book->getThumb() ?>" alt="<?= $book->getTitle() ?>" class="card-img">
                    </td>
                    <td class="title"><?= $book->getTitle() ?></td>
                    <td class="content"><?php $author = $book->getAuthors()[0];
                        echo $author->getFullname() ?></td>
                    <td class="content"><?= $book->getContent() ?></td>


                    <?php if (Utils::user() && $user->getId() == $currentUser->getId()) { ?>

                        <td class="content">
                            <?php
                            if ($book->getStock()) {
                                echo "<span class='badge rounded-pill bg-success'>disponible</span>";

                            } else {
                                echo "<span class='badge rounded-pill bg-danger'>non disponible</span>";
                            }
                            ?>
                        </td>
                        <td class="action">
                            <span class="pill rounded-pill border-danger"></span>
                            <a class="submit"
                               href="index.php?action=updateBookForm&id=<?= $book->getId() ?>&vendor=<?= $user->getId() ?>">
                                edit
                            </a>
                        </td>
                        <td class="action">
                            <a class="submit"
                               href="index.php?action=deleteBook&id=<?= $book->getId() ?>" <?= Utils::askConfirmation("Êtes-vous sûr de vouloir supprimer ce livre ?") ?> >delete</a>
                        </td>
                    <?php } ?>
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


    <?php
    if (Utils::user() && $user->getId() == $currentUser->getId()) {
        ?>
        <a class="submit" href="index.php?action=showUpdateBookForm">Ajouter un $book</a>
        <?php
    }
    ?>
</div>
