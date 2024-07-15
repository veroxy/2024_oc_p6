<div class="d-flex col-md-6">
    <form class="d-flex" xmlns="http://www.w3.org/1999/html">
        <input class="form-control me-2" type="search" placeholder="Rechercher un livre" aria-label="Search">
        <button class="btn btn-outline-success" type="submit">Search</button>
    </form>
</div>
<div class="row">

    <?php
    if (!empty($books)) {
        foreach ($books as $book) { ?>

            <div class="col-xs-2 col-sm-6 col-md-4 col-lg-3 px-2 py-4 align-content-center align-middle">
                <div class="d-flex">
                    <a href="index.php?action=book&id=<?= $book->getId() ?>" class="m-auto text-decoration-none">
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
                            <p class="card-text"><?php $author = $book->getAuthors()[0];
                                echo $author->getFullname() ?></p>

                            <!--                TOFIXED            <p><i>-->
                            <?php //= $book->user->username . " " . $book->user->email ?><!--</i></p>-->
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