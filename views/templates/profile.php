<div class="d-flex w-100 <?= Utils::user() && $user->getId() == $currentUser->getId() ? 'flex-column' : '' ?>">
    <div class="<?= Utils::user() && $user->getId() == $currentUser->getId() ? 'd-flex' : 'col-md-4' ?> ">

        <div class="text-center bg-white rounded p-5 <?= Utils::user() && $user->getId() == $currentUser->getId() ? 'col-md-6' : 'col-md-12' ?>">

            <div class="card-header">
                <img class="bd-placeholder-img rounded-circle" src="<?= $user->getThumb() ?>">
            </div>
            <hr class="py-2 text-light">
            <h2 class="fw-normal"><?= $user->getUsername() ?></h2>
            <p class="text-beige-light">Membre depuis <?= Utils::dateIntervalDuration($user->getCreatedAt()) ?></p>
            <h5 class="t-8">bibliothèque</h5>
            <p><i class=""></i><?= is_int($books) ? $books : count($books) ?> livres</p>
            <?php if (Utils::user() && $user->getId() !== $currentUser->getId() || !Utils::user()) { ?>
                <a href="index.php?action=messenger&sender=<?= $user->getId() ?>"
                   class="btn btn-outline-primary btn-beige-light py-2 px-3 mt-2"><?php ?>
                    Écrire un message</a>
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

                        <input type="password" id="password" class="form-control rounded"
                               value="<?= $user->getPassword() ?>"
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
                    <button class="btn btn-primary w-100 py-2" type="submit">Modifier</button>
                </form>
            </div>
            <?php
        }
        ?>

    </div>
<!--    <div class="bg-white rounded p-3 ">-->

        <?php
        if (Utils::user() && $user->getId() == $currentUser->getId()) {
            echo '<table id="adminBook" class="col table rounded overflow-hidden table-striped table-hover align-middle p-5 ">';
        } else {
        ?>
        <table id="adminBook"
               class="table rounded overflow-hidden table-striped table-hover align-middle p-5 <?= Utils::user() && $user->getId() == $currentUser->getId() ? 'col-lg-6' : '' ?>">

            <?php
            }
            ?>
            <thead>
            <tr class="articleHeaderLine">
                <th scope="col" class="col-2 t-cell text-center text-uppercase">photo</th>
                <th scope="col" class="col-2 t-cell text-center text-uppercase">title</th>
                <th scope="col" class="col-2 t-cell text-center text-uppercase">auteur</th>
                <th scope="col" class="col-2 t-cell text-center text-uppercase">content</th>
                <?php if (Utils::user() && $user->getId() == $currentUser->getId()) { ?>
                    <th scope="col" class="col-2 t-cell text-center text-uppercase">stock</th>
                    <th scope="col" class="col-2 t-cell text-center text-uppercase" colspan="3">actions</th>
                <?php } ?>
            </tr>
            </thead>
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
                        <td class="content"><?= Utils::limitText($book->getContent(),15) ?></td>


                        <?php if (Utils::user() && $user->getId() == $currentUser->getId()) { ?>

                            <td class="content">
                                <?php
                                if ($book->getStock()) {
                                    echo "<span class='badge rounded-pill bg-success-subtle'>disponible</span>";

                                } else {
                                    echo "<span class='badge rounded-pill bg-danger-subtle'>non disponible</span>";
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
                            <td class="action ">
                                <a class="submit text-danger"
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
                    <td colspan='6'><a class='btn btn-primary py-2' href='#/bookNew'>échanger un livre </a></td></tr>";
                }
                echo "</tr>";
            } ?>
        </table>

<!--    </div>-->
    <?php
    if (Utils::user() && $user->getId() == $currentUser->getId()) {
        ?>
        <a class="submit" href="index.php?action=showUpdateBookForm">Ajouter un $book</a>
        <?php
    }
    ?>
</div>
