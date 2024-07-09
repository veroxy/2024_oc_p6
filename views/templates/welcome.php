<div class="row mb-2">
    <div class="col-md-12">
        <figure class="row g-0 border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
            <figcaption class="col-6 p-4 d-flex flex-column position-static">
                <h3 class="mb-0"> Rejoignez nos lecteurs passionnés </h3>
                <p class="card-text mb-auto">Donnez une nouvelle vie à vos livres en les échangeant avec d'autres
                    amoureux de la lecture. Nous croyons en la magie du partage de connaissances et d'histoires à
                    travers les livres. </p>
                <a href="#" class="btn btn-lg btn-success">Découvrir</a>
            </figcaption>
            <div class="col-6 d-none d-lg-block bg-gradient">
                <img src="https://picsum.photos/200" alt="">

            </div>
        </figure>
    </div>
</div>
<div class="row mb-2">

    <?php
    if (!empty($books)) {
    foreach ($books

    as $book) { ?>
    <div class="col-sm-2 col-md-4 col-lg-3">
        <div class="col">
            <a href="index.php?action=book&id=<?= $book->getId() ?>">
            <figure class="card border-0 shadow-sm rounded rounded-4">
                <div>
                    <img src="<?= $book->getThumb() ?>" alt="<?= $book->getThumb() ?>">
                </div>
                <figcaption class="card-body">
                    <h3 class="h3"><?= $book->getTitle() ?></h3>
                    <p class="card-text"><?php
                        $author = $book->getAuthors()[0];
//                        echo $author->getFullname()
                        ?></p>
                    <p><i><?= $book->getContent() ?></i></p>
                </figcaption>
            </figure>
        </a>
    </div>
</div>
<?php
}
} ?>
<div class="text-center">
    <a class="btn btn-lg btn-success" href="index.php?action=books">Nos Livres à l'échanges</a>
</div>
</div>


<div class="row mb-2">

    <img src="https://picsum.photos/200" alt="">
    <div>
        <h3>Nos valeurs</h3>
        <div>
            Chez Tom Troc, nous mettons l'accent sur le partage, la découverte et la communauté. Nos valeurs sont
            ancrées dans notre passion pour les livres et notre désir de créer des liens entre les lecteurs. Nous
            croyons en la puissance des histoires pour rassembler les gens et inspirer des conversations enrichissantes.

            Notre association a été fondée avec une conviction profonde : chaque livre mérite d'être lu et partagé.

            Nous sommes passionnés par la création d'une plateforme conviviale qui permet aux lecteurs de se connecter,
            de partager leurs découvertes littéraires et d'échanger des livres qui attendent patiemment sur les
            étagères.
        </div>
    </div>
</div>