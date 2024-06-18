<form class="d-flex">
    <input class="form-control me-2" type="search" placeholder="Rechercher un livre" aria-label="Search">
    <button class="btn btn-outline-success" type="submit">Search</button>
</form>
<div class="row">
    <?php foreach ($books as $book) { ?>

        <div class="col-sm-2 col-md- col-md-4">
            <div class="col">
                <figure class="card border-0 shadow-sm rounded rounded-4">
                    <svg class="bd-placeholder-img card-img-top" width="100%" height="225"
                         xmlns="http://www.w3.org/2000/svg"
                         role="img" aria-label="Placeholder: Thumbnail" preserveAspectRatio="xMidYMid slice"
                         focusable="false">
                        <title><?= $book->getTitle() ?></title>
                        <rect width="100%" height="100%" fill="#55595c"></rect>
                        <text x="50%" y="50%" fill="#eceeef" dy=".3em"><?= $book->getTitle() ?></text>
                    </svg>

                    <figcaption class="card-body">
                        <h3 class="h3"><?= $book->getTitle() ?></h3>
                        <p class="card-text"><?php $author = $book->getAuthors()[0];
//                        var_dump($book,$author);
                        echo $author->getfullname() ?></p>

                        <p><i><?= $book->getContent() ?></i></p>
                    </figcaption>
                </figure>
            </div>
        </div>
    <?php } ?>
</div>