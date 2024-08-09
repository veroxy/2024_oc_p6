<div class="d-flex col-md-6">

    <form class="d-flex" action="index.php?action=searchBook" method="POST">
        <fieldset class="input-group flex-nowrap">
<!--        <input class="form-control me-2" type="search" placeholder="Rechercher un livre" aria-label="Search">-->
        <span class="input-group-text bg-white border-0" id="addon-wrapping"><svg width="20" height="20" class="DocSearch-Search-Icon" viewBox="0 0 20 20" aria-hidden="true"><path d="M14.386 14.386l4.0877 4.0877-4.0877-4.0877c-2.9418 2.9419-7.7115 2.9419-10.6533 0-2.9419-2.9418-2.9419-7.7115 0-10.6533 2.9418-2.9419 7.7115-2.9419 10.6533 0 2.9419 2.9418 2.9419 7.7115 0 10.6533z" stroke="currentColor" fill="none" fill-rule="evenodd" stroke-linecap="round" stroke-linejoin="round"></path></svg></span>
        <input name="search" type="search" class="form-control border-0" placeholder="Rechercher un livre" aria-label="Search" aria-describedby="addon-wrapping">
        </fieldset>
    </form>

</div>

<div class="row">

    <?php
    if (!empty($books)) {
        foreach ($books as $book) { ?>

            <div class="book-card col-xs-2 col-sm-3 col-md-3 g-5 align-content-center align-self-center">
                <div class="d-block">
                    <a href="index.php?action=book&id=<?= $book->getId() ?>&vendor=<?= $book->getUser()->getId() ?>" class="m-auto text-decoration-none">
                    <figure class="card border-0 shadow-sm rounded rounded-4">
                        <div class="card-img">
                            <img src="<?= $book->getThumb() ?>" alt="place holder img" class="w-100">
                        </div>
                        <figcaption class="card-body">
                            <h3 class="h3"><?= $book->getTitle() ?></h3>
                            <p class="card-text text-body-secondary"><?= $book->getAuthor()->getFullname() ?></p>
                            <p class="text-body-secondary"><i>Vendu par : <?= $book->getUser()->getUsername() ?></i></p>
                        </figcaption>
                    </figure>
                    </a>
                </div>
            </div>
        <?php }
    } else {
        echo "<p class='text-center'>Aucun livre</p>";
        if (Utils::user()) {

            echo "<p class='text-center'><a class='btn btn-primary py-2 btn btn-success' href='#/bookNew'>échanger un livre </a></p>";
        }
    }
    ?>
</div>