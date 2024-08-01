<div class="d-flex col-md-6">

    <form class="d-flex" xmlns="http://www.w3.org/1999/html" action="searchBook" method="GET">
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

            <div class="col-xs-2 col-sm-6 col-md-4 col-lg-3 px-2 py-4 align-content-center align-middle">
                <div class="d-flex">
                    <a href="index.php?action=book&id=<?= $book->getId() ?>&vendor=<?= $book->getUser()->getId() ?>" class="m-auto text-decoration-none">
                    <figure class="card border-0 shadow-sm rounded rounded-4">
                        <div class="card_img" style=" width:200px; height:200px">
                            <svg class="bd-placeholder-img card-img-top" width="200px" height="200px"
                                 xmlns="http://www.w3.org/2000/svg"
alt                                 role="img" aria-label="Placeholder: Thumbnail" preserveAspectRatio="xMidYMid slice"
                                 focusable="false">
                                <title><?= $book->getTitle() ?></title>
                                <rect width="100%" height="100%" fill="#55595c"></rect>
                                <text x="50%" y="50%" fill="#eceeef" dy=".3em"><?= $book->getTitle() ?></text>
                            </svg>
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