<div class="container">
    <div class="row">

        <div class="col">
            <article class="card">
                <figure class="row g-0">
                    <div class="col-md-6">
                        <img src="<?= $book->thumb ?>" alt="<?= $book->title ?>">
                    </div>
                    <figcaption class="col-md-6">
                        <div class="card-body">
                            <h5 class="card-title"><?= $book->title ?></h5>
                            <?php if (isset($book->authors)) {
                                ?>
                                <div>
                                    <?php if (count($book->authors) > 1) {
                                        foreach ($book->authors as $author) { ?>

                                            <p class="card-text"><small
                                                        class="text-muted"><?= $author->fullname ?></small></p>
                                        <?php }
                                    } else {
                                        $author = $book->authors[0];
                                        ?>
                                        <p class="card-text"><small class="text-muted"><?= $author->fullname ?></small>
                                        </p>


                                    <?php } ?>
                                </div>
                            <?php } ?>
                            <p class="card-text"><?= $book->content ?></p>
                        </div>
                        <footer class="col">
                            <h5>proprietaire</h5>
                            <div>
                                <a href="index.php?action=profile&id=<?= $book->user->getId() ?>"
                                <span class="badge align-items-center rounded">
                                    <img src="<?= $book->user->thumb ?>" alt="" width="32" height="32"
                                         class="rounded-circle me-2">=
                                <?= $book->user->username ?>
                                </span>
                                </a>
                            </div>
                            <div class="col">
                                <a href="index.php?action=messenger&id=<?= $book->user->getId() ?>" class="btn btn-success"><?php ?>envoyer un message</a>
                            </div>
                        </footer>
                    </figcaption>

                </figure>
            </article>
        </div>


    </div>
</div>
