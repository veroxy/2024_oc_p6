<article class="d-flex align-items-center pe-auto pb-3">
    <div class="container">
        <figure class="card-body d-flex g-0 flex-md-row mb-4 position-relative">
            <figcaption class="col-6 p-5 d-flex flex-column position-static align-self-end">
                <h3 class="mb-0 card-title"> Rejoignez nos lecteurs passionnés </h3>
                <p class="card-text">Donnez une nouvelle vie à vos livres en les échangeant avec d'autres
                    amoureux de la lecture. Nous croyons en la magie du partage de connaissances et d'histoires à
                    travers les livres. </p>
                <a href="#" class="btn btn-lg btn-success">Découvrir</a>
            </figcaption>

            <div class="col-6 d-none d-lg-block bg-gradient">
                <img src="https://picsum.photos/200" alt="" class="card-img-top">
            </div>
        </figure>
    </div>
</article>
<div class="d-flex align-items-center pe-auto pb-3">
    <div class="container">
        <div class="row mb-2">

            <?php
            if (!empty($books)) {
                foreach ($books

                         as $book) { ?>
                    <article class="col-6 col-lg-3">
                        <div class="col">
                            <figure class="card border-0 shadow-sm rounded rounded-4">
                                <div>
                                    <a href="index.php?action=book&id=<?= $book->getId() ?>">
                                        <img src="" alt="<?= $book->getTitle() ?>" class="placeholder card-img-top" alt>
                                    </a>
                                </div>
                                <figcaption class="card-body">
                                    <a href="index.php?action=book&id=<?= $book->getId() ?>&vendor=<?= $book->getUser()->getId() ?>">
                                        <h3 class="h3"><?= $book->getTitle() ?></h3>
                                        <p class="card-text"><?= $book->getAuthor()->getFullname() ?></p>
                                        <p><i>Vendu par : <?= $book->getUser()->getUsername() ?></i></p>
                                    </a>
                                </figcaption>
                            </figure>
                        </div>
                    </article>
                    <?php
                }
            } ?>
        </div>
        <div class="text-center">
            <a class="btn btn-lg btn-success" href="index.php?action=books">Nos Livres à l'échanges</a>
        </div>
    </div>
</div>

<div class="d-flex align-items-center pe-auto">
    <div class="container">
        <div class="row mb-2">

            <img src="https://picsum.photos/200" alt="">
            <div>
                <h3>Nos valeurs</h3>
                <div>
                    Chez Tom Troc, nous mettons l'accent sur le partage, la découverte et la communauté. Nos valeurs
                    sont
                    ancrées dans notre passion pour les livres et notre désir de créer des liens entre les lecteurs.
                    Nous
                    croyons en la puissance des histoires pour rassembler les gens et inspirer des conversations
                    enrichissantes.

                    Notre association a été fondée avec une conviction profonde : chaque livre mérite d'être lu et
                    partagé.

                    Nous sommes passionnés par la création d'une plateforme conviviale qui permet aux lecteurs de se
                    connecter,
                    de partager leurs découvertes littéraires et d'échanger des livres qui attendent patiemment sur les
                    étagères.
                </div>
            </div>
        </div>
    </div>
</div>