<div class="container">
    <div class="row">
        <div class="col">
            <article class="card border-0 bg-none">
                <figure class="row g-0">
                    <div class="col-md-6">
                        <img src="<?= $book->getThumb() ?>" alt="<?= $book->getTitle() ?>" class="img-fluid w-100">
                    </div>
                    <figcaption class="col-md-6 p-2 d-flex  align-items-start flex-column ">
                        <div class="card-body">
                            <h5 class="card-title"><?= $book->getTitle() ?></h5>
                            <?php $authors = $book->getAuthors() ;
                            if (isset($authors)) {
                                ?>
                                <div>
                                    <?php if (count($book->getAuthors()) > 1) {
                                        foreach ($book->getAuthors() as $author) { ?>

                                            <p class="card-text"><small
                                                        class="text-muted"><?= $author->getFullname() ?></small></p>
                                        <?php }
                                    } else {
                                        $author = $book->getAuthors()[0];
                                        ?>
                                        <p class="card-text"><small class="text-muted"><?= $author->getFullname() ?></small>
                                        </p>


                                    <?php } ?>
                                </div>
                            <?php } ?>
                            <p class="card-text"><?= $book->getContent() ?></p>
                        </div>
                        <footer class="col">
                            <h5>proprietaire</h5>
                            <div>
                                <a href="index.php?action=profile&id=<?= $book->getUser()->getId() ?>" class="text-decoration-none">
                                <span class="badge align-items-center rounded text-black">
                                    <img src="<?= $book->getUser()->getThumb() ?>" alt="" width="32" height="32"
                                         class="rounded-circle me-2">
                                <?= $book->getUser()->getUsername() ?>
                                </span>
                                </a>
                            </div>
                            <div class="col">
                                <a href="index.php?action=messenger&sender=<?= $book->getUser()->getId() ?>" class="btn btn-success"><?php ?>envoyer un message</a>
                            </div>
                        </footer>
                    </figcaption>

                </figure>
            </article>
        </div>
    </div>
</div>
